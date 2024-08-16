<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Conexão com o banco de dados -->
    <?php
    include_once "conexao.php";
    ?>
    <h1>CRUD PHP usando PDO</h1>
    <a href="cadastro.php">Cadastrar</a>
    <?php
    $id = 1;
    $select = $conexao->prepare("SELECT * FROM usuario");
    $select->execute();

    $resultado = $select->fetch(PDO::FETCH_ASSOC); /* Quando utilizado o "FETCH_DEFAULT" o a conexão PDO irá trazer todos o índices*/
    // echo "<pre>";
    // print_r($resultado);
    // echo $resultado['nome'];
    ?>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>CPF</th>
            <th>Senha</th>
        </tr>
        <?php
        while ($resultado = $select->fetch(PDO::FETCH_ASSOC)) {
            echo '
            <tr>
                <td>' . $resultado['id_usuario'] . '</td>
                <td>' . $resultado['nome'] . '</td>
                <td>' . $resultado['email'] . '</td>
                <td>' . $resultado['cpf'] . '</td>
                <td>' . $resultado['senha'] . '</td>
            </tr>';
        }
        ?>
    </table>
</body>

</html>