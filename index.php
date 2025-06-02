<?php
// Lê o arquivo de dados
$dados = [];
$blocos = preg_split("/\r?\n\r?\n/", file_get_contents("dados.txt"));

foreach ($blocos as $bloco) {
    $linhas = preg_split("/\r?\n/", trim($bloco));
    $usuario = '';
    $senha = '';
    foreach ($linhas as $linha) {
        if (strpos($linha, "Usuário:") === 0) {
            $usuario = trim(substr($linha, strlen("Usuário:")));
        } elseif (strpos($linha, "Senha:") === 0) {
            $senha = trim(substr($linha, strlen("Senha:")));
        }
    }
    if ($usuario && $senha) {
        $dados[$usuario] = $senha;
    }
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioInput = trim($_POST['usuario'] ?? '');
    $senhaInput = trim($_POST['senha'] ?? '');

    if (isset($dados[$usuarioInput]) && $dados[$usuarioInput] === $senhaInput) {
        echo '
        <form id="redirecionar" method="post" action="redirecionar.php">
          <input type="hidden" name="usuario" value="'.htmlspecialchars($usuarioInput).'">
        </form>
        <script>document.getElementById("redirecionar").submit();</script>';
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acesso ao Relatório Comercial</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Roboto', sans-serif;
    }
    body {
      background: url('Página-entrar.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      position: relative;
    }
    .logo-container {
      position: absolute;
      top: 30px;
      width: 100%;
      text-align: center;
    }
    .logo-container img {
      max-width: 280px;
      height: auto;
      margin-bottom: 20px;
      padding-top: 45px;
    }
    .login-box {
      background-color: rgba(255, 255, 255, 0.50);
      padding: 50px;
      border-radius: 10px;
      text-align: center;
      width: 350px;
      z-index: 1;
    }
    h1 {
      margin-bottom: 5px;
      font-size: 24px;
      color: rgba(1, 42, 71, 0.85);
      font-weight: 700;
    }
    h2 {
      margin-top: 0;
      font-size: 16px;
      color: rgba(1, 42, 71, 0.85);
      font-weight: 500;
    }
    p {
      margin: 15px 0 10px;
      font-size: 14px;
      color: rgba(3, 61, 103, 0.85);
    }
    input,
    button {
      width: 100%;
      box-sizing: border-box;
    }
    input {
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    button {
      padding: 10px;
      background-color: #1d3b5f;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }
    button:hover {
      background-color: #164177;
    }
    .forgot {
      margin-top: 30px;
      font-size: 12px;
      color: #444;
      line-height: 1.5;
    }
    .error {
      color: red;
      font-size: 14px;
    }
  </style>
</head>
<body>

  <div class="logo-container">
    <img src="Cirurgia Segura - Logo Branca.png" alt="Logo Cirurgia Segura">
  </div>

  <div class="login-box">
    <h1>Acesso ao Relatório Comercial</h1>
    <h2>Corretor/Plataforma</h2>
    <p>Preencha os campos para acessar as informações</p>

    <?php if ($erro): ?>
      <p class="error"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="usuario" placeholder="Usuário" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button type="submit">Entrar</button>
    </form>

    <p class="forgot">Esqueceu a senha?<br>Entre em contato com o Suporte Comercial</p>
  </div>

</body>
</html>
