## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Contextual Links and Actionable Contact Info]
**Learning:** Generic links like "Ler Artigo" or "Ver Detalhes" create accessibility barriers for screen reader users. Adding descriptive aria-labels (e.g., ":aria-label=\"'Ler artigo sobre ' + article.title\"") provides necessary context. Additionally, converting plain-text contact info into tel: and mailto: links improves mobile UX, and using Bootstrap utility classes (text-decoration-none, text-reset) keeps these links visually consistent with the design.
**Action:** Always audit for repetitive/generic link text and convert contact information into functional links using standard URI schemes and non-intrusive styling.
