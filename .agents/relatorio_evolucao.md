# Relatório de Evolução — Cardoso & Bruno novoSite

Este arquivo registra o progresso, as modificações estruturais e o versionamento do site institucional contido no diretório `novoSite`.

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

