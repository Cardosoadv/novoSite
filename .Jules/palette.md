## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Contextual ARIA labels for generic links]
**Learning:** Generic link text like "Ver Detalhes" or "Ler Artigo" becomes ambiguous for screen reader users when multiple instances exist on the same page. Providing unique `aria-label` attributes that include the specific subject (e.g., article title or expertise area) significantly improves navigation.
**Action:** Always check for repeated generic link text and add contextual labels using available dynamic data.
