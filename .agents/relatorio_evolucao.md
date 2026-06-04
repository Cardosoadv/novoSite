# Relatório de Evolução — Cardoso & Bruno novoSite

Este arquivo registra o progresso, as modificações estruturais e o versionamento do site institucional contido no diretório `novoSite`.

## [v1.0.9] - 2026-06-04

### 🐛 Correção do Erro de Renderização do XML no Sitemap e Leitura do .env

- **Frontend (Servidor)**:
  - O script `sitemap.php` foi aprimorado para realizar a higienização (sanitização) do XML retornado pela API do backend.
  - Remove os comentários de Debug View injetados pelo CodeIgniter (ex: `<!-- DEBUG-VIEW ... -->`), além de limpar qualquer caractere ou espaço em branco antes e depois do XML. Isso previne o erro `Start tag expected, '<' not found` no navegador ao carregar o sitemap.
  - Implementada a leitura manual do arquivo `.env` como fallback caso o script seja executado fora do contexto do framework (via redirecionamento do Apache / Apache rewrite), permitindo a leitura correta de `SitemapUrl`.

## [v1.0.8] - 2026-06-03

### 🐛 Melhoria no Proxy do Sitemap e Correção de View Ausente

- **Frontend (Servidor)**:
  - O script `sitemap.php` foi refatorado para utilizar `cURL` ao invés de `file_get_contents`. Isso resolve problemas de conectividade em ambientes locais (XAMPP) no Windows, garantindo que a requisição não trave ao tentar resolver o DNS. O cURL agora aponta forçadamente para `127.0.0.1` e passa o header `Host: localhost`.

## [v1.0.7] - 2026-06-03

### 🐛 Correção do Sitemap (404 CodeIgniter)

- **Frontend (Servidor)**:
  - Adicionado o arquivo `sitemap.php` que atua como um proxy para buscar o XML diretamente do backend via HTTP e retorná-lo com o Content-Type correto.
  - Atualizada a regra no `.htaccess` para redirecionar `sitemap.xml` para `sitemap.php`. Isso corrige o problema onde o redirecionamento interno anterior não alterava o `REQUEST_URI` visto pelo roteador do CodeIgniter 4, resultando no erro `404 Can't find a route for 'GET: novoSite/sitemap.xml'`.

## [v1.0.6] - 2026-06-03

### ✨ Configuração do Sitemap

- **Servidor (.htaccess)**:
  - Adicionada regra de redirecionamento interno (`RewriteRule`) para o arquivo `sitemap.xml`.
  - O acesso à `localhost/novoSite/sitemap.xml` agora mapeia para a API de sitemap do backend.

## [v1.0.5] - 2026-06-03

### 🐛 Correção da Rota de Notícias na Home

- **Frontend (Vue 3 SPA)**:
  - Corrigido o `fetchLatestNews` no componente `Home.vue` que estava utilizando a `baseUrl` e a rota legada `/api/noticias`.
  - Agora a busca das últimas notícias na Home utiliza corretamente a `apiUrl` e o endpoint `/noticias` configurado, alinhando com a listagem de notícias.

## [v1.0.4] - 2026-06-03

### 🐛 Correção de Bug do Logo (404)

- **Frontend (Vue 3 SPA)**:
  - O arquivo `logo.png` não estava sendo exibido na navbar e footer porque estava referenciando um diretório inexistente gerado incorretamente pelo build.
  - Modificado `src/App.vue` para remover a importação explícita do `logo.png` via bundler.
  - O `logoUrl` agora é resolvido de forma estática com base no `window.__APP_CONFIG__.baseUrl` apontando para `assets/img/logo.png`.
  - Essa mudança previne que a diretiva de _Single File App_ cause problemas com o tamanho do bundle e perda do caminho da imagem em produção.

## [v1.0.3] - 2026-06-03

### ✨ Criação da Área do Cliente

- **Frontend (Vue 3 SPA)**:
  - Adicionado o componente `AreaCliente.vue` (`src/views/AreaCliente.vue`) contendo o formulário para solicitação do Magic Link da API de `processos`. O design segue o padrão premium (Glassmorphism e cores ouro/marinho).
  - Atualizada a rota `src/router/index.js` para registrar `/area-cliente`.
  - Inserido um link discreto no footer no arquivo `src/App.vue` para acesso à Área do Cliente.

## [v1.0.2] - 2026-06-03

### ✨ Importação do Favicon

- Importado o favicon (`favicon.ico`) do site legado para o novo diretório e adicionado à pasta `public` do novo site, além de estar na raiz do projeto.

## [v1.0.1] - 2026-06-03

### 🐛 Correção do Formulário de Contato

- **Frontend (Vue 3 SPA)**:
  - **Bug crítico corrigido** em `Home.vue`: a função `handleSubmit()` tentava ler `document.querySelector('meta[name="csrf-header"]')` diretamente, sem verificar se o elemento existia no DOM. Como o `index.html` não possui a meta tag `csrf-header`, isso causava um `TypeError: Cannot read properties of null (reading 'getAttribute')` ao submeter o formulário.
  - Implementada leitura defensiva das meta tags CSRF com verificação de nulidade (`csrfTokenMeta ? ... : fallback`), tornando o formulário funcional tanto em modo SPA puro (sem PHP) quanto quando servido via backend PHP que injeta os tokens.
  - O header CSRF só é enviado quando o token estiver presente, evitando o envio de tokens vazios/inválidos.
  - **Ajuste em `fetchAreas()`**: o parse do retorno da API agora aceita tanto `array` direto (formato atual do backend) quanto objeto com chave `.data`, tornando o código mais resiliente a mudanças de formato da API.
  - Adicionado fallback para `result.message` quando `result.status === 'success'` mas a mensagem não vier no payload.
  - Adicionado suporte ao formato `result.errors` (array) além de `result.messages` (objeto) nos erros de validação.

