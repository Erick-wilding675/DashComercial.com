<?php
// ==========================================================
// index.php - Tela de login do sistema de relatórios
// ==========================================================

// Lê o arquivo de dados com os usuários e senhas válidos
$dados = [];
$blocos = preg_split("/\r?\n\r?\n/", file_get_contents("dados.txt")); // Separa blocos por linha em branco

foreach ($blocos as $bloco) {
    $linhas = preg_split("/\r?\n/", trim($bloco)); // Separa cada linha do bloco
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

// Verifica envio e login
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

<!-- =================== HTML =================== -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acesso ao Relatório Comercial</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <!-- =================== Estilo CSS =================== -->
  <style>
    html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  font-family: 'Roboto', sans-serif;
}

body {
  background: url('Página-entrar.jpg') no-repeat center center;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  padding: 40px 20px;
  box-sizing: border-box;
}

/* Logo */
.logo-container {
  width: 100%;
  text-align: center;
  margin-bottom: 30px;
}

.logo-container img {
  max-width: 280px;
  height: auto;
  margin-bottom: 20px;
  padding-top: 45px;
}

/* Login Box */
.login-box {
  background-color: rgba(255, 255, 255, 0.5);
  padding: 50px;
  border-radius: 10px;
  text-align: center;
  width: 100%;
  max-width: 350px;
  z-index: 1;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

h1, h2, p {
  color: rgba(1, 42, 71, 0.85);
}
h1 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 5px;
}
h2 {
  font-size: 16px;
  font-weight: 500;
  margin-top: 0;
}
p {
  font-size: 14px;
  margin: 15px 0 10px;
}

input, button {
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

/* Responsividade */
@media (max-width: 720px) {
  .login-box {
    padding: 50px 30px;
  }
  .logo-container img {
    max-width: 300px;
    padding-top: 20px;
  }
  h1 {
    font-size: 20px;
  }
  h2 {
    font-size: 14px;
  }
  p, .forgot {
    font-size: 13px;
  }
  input, button {
    font-size: 14px;
  }
}

@media (max-width: 480px) {
  .logo-container {
    top: 50px;
  }
  .logo-container img {
    max-width: 200px;
    padding-top: 10px;
  }
  .login-box {
    padding: 20px 15px;
    border-radius: 8px;
    max-width: 280px;
  }
  h1 {
    font-size: 18px;
  }
  h2 {
    font-size: 13px;
  }
  input, button {
    font-size: 13px;
  }
}


  </style>
</head>
<body>

  <!-- Logo -->
  <div class="logo-container">
    <img src="Cirurgia Segura - Logo Branca.png" alt="Logo Cirurgia Segura">
  </div>

  <!-- Formulário de Login -->
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


</body>
</html>
