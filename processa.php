<?php

include_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Adicionar Switch case

    $erro = "";
    $nome = $_POST['nome'];
    if (empty($nome) || strlen($nome) < 2) {
        $erro .= "Digite um nome <br>";
    }
    $email = $_POST['email'];
    if (empty($email)) {
        $erro .= "Digite um E-mail <br>";
    } else {

        $selectEmail = $conexao->prepare("SELECT email FROM usuario WHERE email = :email");
        $selectEmail->bindParam('email', $email);
        $selectEmail->execute();
        if ($selectEmail->rowCount()) {
            $erro .= "Email já cadastrado! <br>";
        }
    }
    $cpf = $_POST['cpf'];
    if (empty($cpf) || strlen($cpf) != 11) {
        $erro .= "Digite o CPF com 11 digitos <br>";
    } else {
        $selectCPF = $conexao->prepare("SELECT cpf FROM usuario WHERE cpf = :cpf");
        $selectCPF->bindParam('cpf', $cpf);
        $selectCPF->execute();

        if ($selectCPF->rowCount()) {
            $erro .= "CPF já cadastrado! <br>";
        }
    }
}
$senha = $_POST['senha'];
if (empty($senha) || strlen($senha) < 8) {
    $erro .= "[ERRO] Digite uma senha de no mínmo 8 caracteres <br>";
} else {
    $senhaCripto = password_hash($senha, PASSWORD_DEFAULT);
}

echo $erro;
if ($erro == "") {
    $novo = [
        'nome' => $nome,
        'email' => $email,
        'cpf' => $cpf,
        'senha' => $senhaCripto
    ];

    $insert = $conexao->prepare("INSERT INTO usuario (nome, email, cpf, senha) VALUES (:nome, :email, :cpf, :senha)");
    // $insert->bindParam(':nome', $nome);
    // $insert->bindParam(':email', $email);
    // $insert->bindParam(':cpf', $cpf);
    // $insert->bindParam(':senha', $senha);
    if ($insert->execute($novo)) {
        // header('location: cadastro.php?status=ok');
        echo "Cadastrado com sucesso!! 🥳🥳";
    } else {
        // header('location: cadastro.php?status=erro');
        echo "Erro na inserção do banco na tentativa de cadastrar! 😕";
    };
}
