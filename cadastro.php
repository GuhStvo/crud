<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuários</title>

    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        form div {
            max-width: 235px;
            display: flex;
            justify-content: space-between;

            input {
                border: 1.5px solid #ccc;
                border-radius: 12px;
                height: 25px;
            }
        }
    </style>
</head>
<body>
    <dialog id="avisos"></dialog>
    <h1>Cadastrar usuários</h1>
    <form method="post" id="form_cadastro">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf">
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
    </form>

    <script src="./cadastro.js"></script>
</body>
</html>