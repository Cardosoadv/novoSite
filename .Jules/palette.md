## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-20 - [Descriptive ARIA labels and Actionable Contact Links]
**Learning:** Repetitive generic links like "Ver Detalhes" or "Ler Artigo" are common accessibility blockers for screen reader users. Supplementing them with context-aware `aria-label` attributes significantly improves the navigational experience. Additionally, making phone numbers and emails clickable via `tel:` and `mailto:` is a low-effort, high-impact UX win for mobile users.
**Action:** Always provide context for generic CTA links and ensure contact information is actionable. Use Bootstrap's `text-decoration-none` and `text-reset` to maintain visual design while adding semantic link functionality.
