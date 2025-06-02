## Testes de Login e Redirecionamento por Usuário
 Todos os usuários listados no arquivo redirecionar.php devem passar por testes básicos de validação de acesso e redirecionamento de dashboard.
 Para cada usuário, devem ser realizados os seguintes testes:

## 1. Teste de Login com Credenciais Válidas
 Objetivo: Garantir que o sistema aceita as credenciais conforme definidas no arquivo dados.txt.
 Passos:
    - Acessar index.php.
    - Inserir o nome de usuário e senha correspondentes.
    - Clicar em “Entrar”.
 Resultado Esperado:
    Redirecionamento automático para redirecionar.php com envio do POST.

## 2. Teste de Redirecionamento Correto
 Objetivo: Confirmar que o redirecionamento após o login leva ao dashboard correto do Power BI.
 Passos:
    - Observar o valor decodificado da variável encodedUrl no script JS.
    - Verificar se ele corresponde ao link configurado para o usuário no array $destinos.
 Resultado Esperado:
    O iframe deve carregar a URL exata definida para o usuário.

## 3. Teste de Carregamento do Dashboard
 Objetivo: Garantir que o relatório é carregado corretamente no navegador.
 Passos:
    - Verificar se o iframe com ID myIframe carrega o conteúdo após o login.
    - Confirmar visualmente ou via ferramenta que houve resposta HTTP 200.
 Resultado Esperado:
    O dashboard deve ser exibido sem erros, com conteúdo carregado.

## Verificação de Integridade dos Dados dos Dashboards
 Para garantir que os dashboards estão exibindo os dados corretos e atualizados, será realizada uma checagem de consistência comparando:
 
 Os dashboards acessados via redirecionamento (Power BI individual).
 O Cockpit (Excel), base de dados principal.
 O Dash Geral dos Administradores do Cirurgia Segura (Power BI).

## Procedimentos de Validação

    -Identificar métricas principais no dashboard (KPIs como vendas, conversões, faturamento, etc.).
    - Abrir o Cockpit (Excel) e extrair os mesmos dados manual ou automaticamente.
    - Abrir o Dash Geral dos Administradores e comparar os mesmos dados.
    - Validar que os dados estão consistentes entre todas as fontes.

## Frequência Recomendada
 Checagem diária ou conforme atualização das planilhas e dashboards.
 Recomenda-se a automação parcial com planilhas auxiliares ou scripts de leitura do Excel (ex: Python com pandas, PHP com PhpSpreadsheet).

## Observações
 Usuários que possuem campo vazio no array $destinos devem ser verificados quanto à necessidade ou não de redirecionamento.
 É recomendado manter um log de testes por usuário, incluindo:
    - Resultado do login.
    - URL de redirecionamento.
    - Status de carregamento do iframe.
    - Resultado da verificação de dados (conforme última atualização do Excel).
