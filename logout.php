<?php
// ==========================================================
// logout.php - Encerra a sessão do usuário e redireciona para o login
// ==========================================================

session_start(); // Inicia ou continua a sessão atual

session_destroy(); // Encerra a sessão, removendo todos os dados armazenados

// Redireciona o usuário de volta para a tela de login
header("Location: index.php");
exit;
