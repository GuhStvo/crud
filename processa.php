<?php

include_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $novo = [
        'nome' => $nome,
        'email' => $email,
        'cpf' => $cpf,
        'senha' => $senha
    ];

    $insert = $conexao->prepare("INSERT INTO usuario (nome, email, cpf, senha) VALUES (:nome, :email, :cpf, :senha)");
    // $insert->bindParam(':nome', $nome);
    // $insert->bindParam(':email', $email);
    // $insert->bindParam(':cpf', $cpf);
    // $insert->bindParam(':senha', $senha);
    if($insert->execute($novo)) {
        header('location: cadastro.php?status=ok');
    } else {
        header('location: cadastro.php?status=erro');
    };
}
