<?php
// Garante que foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['usuario'])) {
    header("Location: index.php");
    exit;
}

$usuario = $_POST['usuario'];

$destinos = [
    "admteste" => "https://app.powerbi.com/view?r=eyJrIjoiYmM3NDUxZDItN2IzOS00ODk0LThkNjYtZDRjN2VjZDA3ZjNjIiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "marcos" => "https://app.powerbi.com/view?r=eyJrIjoiYzI1NGMwNzItZjQwZi00YzI2LTg3ZTYtMmNmNmRkYTBjNzNiIiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "acaff" => "https://app.powerbi.com/view?r=eyJrIjoiNTc2OGUyYTItZWVkZS00YmFhLWFkMDEtOTE0ZmEyZjExNDViIiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "seguremed" => "https://app.powerbi.com/view?r=eyJrIjoiZjVkNGEzNzYtMzdkZC00NzI5LTkzYzEtNjJlYzZhNTY4Yjg0IiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "paganiniadm" => "",
    "meliusconsultoria" => "https://app.powerbi.com/view?r=eyJrIjoiNGIxMDQ2M2UtMjZiYy00NDM4LTgzZWMtYWE4M2ZiMWYzZGFjIiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "renatoRD" => "https://app.powerbi.com/view?r=eyJrIjoiM2I3OTU3ODAtZmMyYi00NTJhLWIxMjctOTU5ODE3NmJkNGUwIiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",    
    "montioli" => "https://app.powerbi.com/view?r=eyJrIjoiNjUzOGI2MjYtNzBmZS00MjQ1LWFmN2ItNGRkYTEwN2YwZjA2IiwidCI6ImMyNjljZjdkLTAzNDgtNDZlNC04NzgyLTBmNzFmYTJkMDgwOCJ9",
    "gurgel" => "",
    "cleiarodrigues"=> "",
    "medicinasegura"=> "",
    "attielucidos"=> "",
    "jarbas"=> "",
    "reinaldogomes"=> "",
    "rejane"=> "",
    "raquellima"=>  "",
    "edimar"=> "",
    "cleidiocorretora"=>  "",
    ""=> "",
];

$url = $destinos[$usuario] ?? '';

if (!$url) {
    echo "Relatório não encontrado para este usuário.";
    exit;
}

// Base64 encode da URL
$encodedUrl = base64_encode($url);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Relatório Comercial</title>
  <style>
    html, body {
      margin: 0; padding: 0; height: 100%;
    }
    iframe {
      border: none; width: 100%; height: 100%;
    }
  </style>
</head>
<body>
    <iframe id="myIframe" allowfullscreen></iframe>

    <script>
        // Recebe a URL em base64 direto do PHP
        const encodedUrl = "<?= $encodedUrl ?>";
        // Decodifica a URL
        const url = atob(encodedUrl);
        // Seta a URL no iframe
        document.getElementById('myIframe').src = url;
    </script>
</body>
</html>
