<?php
// ==========================================================
// redirecionar.php - Redireciona o usuário logado para seu link do Power BI
// ==========================================================

// Verifica se o acesso foi feito via POST e se o usuário foi enviado
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['usuario'])) {
    header("Location: index.php");
    exit;
}

$usuario = $_POST['usuario'];

// Mapeia os usuários aos respectivos links de relatório no Power BI
$destinos = [
    "exemplo1" => "https://app.powerbi.com/exemplo1",
    "exemplo2" => "https://app.powerbi.com/exemplo2",
    "exemplo3" => "https://app.powerbi.com/exemplo3",
];

// Obtém a URL correspondente ao usuário logado
$url = $destinos[$usuario] ?? '';

// Se não houver URL definida para o usuário, exibe erro
if (!$url) {
    echo "Relatório não encontrado para este usuário.";
    exit;
}

// Codifica a URL em base64 para dificultar a leitura no código-fonte
$encodedUrl = base64_encode($url);
?>

<!-- =================== HTML =================== -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Relatório Comercial</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    iframe {
      border: none;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>

  <!-- Iframe que receberá o link do Power BI -->
  <iframe id="myIframe" allowfullscreen></iframe>

  <script>
    // Recupera a URL codificada via PHP
    const encodedUrl = "<?= $encodedUrl ?>";

    // Decodifica a URL de base64 para texto normal
    const url = atob(encodedUrl);

    // Define o link no iframe para exibir o relatório
    document.getElementById('myIframe').src = url;
  </script>

</body>
</html>
