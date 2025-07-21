## Descrição Geral
 Este arquivo redireciona o usuário autenticado para o link correspondente ao seu login, baseado em uma lista pré-definida de URLs associadas a cada usuário.

## Funcionamento do Código
### 1. Validação do Método e Dados
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['usuario'])) {
        header("Location: index.php");
        exit;
        } 
 > Garante que o acesso foi feito via POST e que o nome do usuário está presente. Se não estiver, o usuário é redirecionado de volta ao login (index.php).

### 2. Associação Usuário → Relatório
        $destinos = [
            "usuario1" => "link1",
            "usuario2" => "link2",
            ...
        ];
 > Lista que mapeia usuários a seus respectivos links do Power BI. Usuários sem link têm valor vazio ("") e receberão uma mensagem de erro.

 ### 3. Verificação e Redirecionamento
        $url = $destinos[$usuario] ?? '';
        if (!$url) {
        echo "Relatório não encontrado para este usuário.";
        exit;
        }
 > Se não houver link associado ao usuário, exibe uma mensagem de erro.

 ### 4. Proteção da URL com Base64
        $encodedUrl = base64_encode($url);
 > Codifica a URL para não deixá-la explícita no HTML.

 ### 5. Exibição via iframe
    <iframe id="myIframe" allowfullscreen></iframe>
    <script>
    const encodedUrl = "<?= $encodedUrl ?>";
    const url = atob(encodedUrl);
    document.getElementById('myIframe').src = url;
    </script>
 > A URL é decodificada no navegador e embutida num iframe, que exibe o relatório.

## Pontos de Atenção
 Segurança:	As URLs ainda podem ser acessadas se alguém inspecionar o código da página
 \nPrivacidade: Recomendado usar autenticação de sessão PHP para garantir proteção total
 \nOrganização: Seria melhor separar a lista de usuários em um arquivo próprio, como JSON
 \nUX: Quando não houver relatório, redirecionar para uma página amigável

## Melhorias Sugeridas
 Evitar echo cru: Quando não há link, usar header("Location: erro.php") para uma página com design amigável.
 \nModularizar: Separar os links de usuários em um arquivo externo, por exemplo, destinos.json.
 \nProteção contra spoofing: Validar se o usuário foi realmente autenticado via $_SESSION.
