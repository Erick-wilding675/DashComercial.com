## Descrição Geral
 Este arquivo encerra a sessão do usuário, destruindo todos os dados armazenados, e o redireciona de volta para a tela de login (index.php).

### Funcionamento do Código
 session_start(); 
 > Inicia a sessão atual. Isso é necessário para poder destruí-la logo em seguida.
 session_destroy();
 > Remove todos os dados da sessão do usuário atual (como variáveis de login ou permissões).
 header("Location: index.php");
 exit;
 > Redireciona o usuário para a página de login e finaliza o script imediatamente com exit.

### Código
 <?php
 session_start();
 session_destroy();
 header("Location: index.php");
 exit;
