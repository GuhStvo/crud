<?php

include_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $erro = "";
    $nome = $_POST['nome'];

    $padraoSenha = '~(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*\(\)\_\+\[\]\{\}\|\:\"\<\>\.\,\/\?\-]).{8,}$~';

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
    /* Verificação para formato de cpf */
    $padraoCPF = '~^\d{3}\.?\d{3}\.?\d{3}-?\d{2}$~';
    $cpf = $_POST['cpf'];
    if (!preg_match($padraoCPF, $cpf)) {
        $erro .= "Digite o CPF nesse formato [000.000.000-00] <br>";
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

if (!preg_match($padraoSenha, $senha)) {
    $erro .= "[ERRO] Digite uma senha contendo no mínimo 8 caracteres, uma letra maíuscula, uma minuscula, caracter especial e um número. <br>";
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