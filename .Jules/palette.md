## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2026-06-04 - [Actionable Contact Info and Accessible Links]
**Learning:** Wrapping static phone numbers and emails in `tel:` and `mailto:` links with `text-decoration-none text-reset` classes improves mobile actionability, and adding descriptive `aria-label`s to generic links (like "Ver Detalhes" or "Ler Artigo") provides critical screen reader context without any visual impact.
**Action:** For every static contact detail, use Bootstrap helper classes to link them safely, and enrich generic/repetitive links with dynamic or static `aria-label`s to elevate overall site accessibility.
