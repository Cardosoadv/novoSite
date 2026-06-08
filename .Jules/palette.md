## 2025-05-15 - [Skip to Content Implementation]
**Learning:** For a "Skip to Content" link to work effectively in a Vue SPA, the target element (e.g., `<main id="main-content">`) must have `tabindex="-1"`. This allows the browser to move focus to the element even if it isn't naturally interactive.
**Action:** Always include `tabindex="-1"` on the skip link target and ensure it has a clear ID.

## 2025-05-15 - [Runtime Configuration Dependency]
**Learning:** This application depends on a `config.js` file defining `window.__APP_CONFIG__` for basic rendering (e.g., news API base URLs). Without it, the app may crash or fail to load dynamic content in development environments.
**Action:** When setting up a local dev environment for testing, verify if a mock `config.js` is needed to satisfy runtime requirements.

## 2025-05-15 - [Accessible Dynamic Links]
**Learning:** Generic call-to-action links like "Ler Artigo" (Read Article) or "Ver Detalhes" (View Details) are ambiguous for screen reader users when multiple exist on a page.
**Action:** Use `aria-label` to provide specific context (e.g., `aria-label="Ler artigo: [Título]"`) for dynamic links while keeping the visual text concise.
