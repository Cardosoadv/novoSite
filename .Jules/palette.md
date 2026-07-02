## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-22 - [Descriptive Link Labels & Actionable Contact Info]
**Learning:** For accessibility, generic "Ver Detalhes" links must be disambiguated using `aria-label` providing specific context. For usability, contact text (phone/email) should be wrapped in `tel:` and `mailto:` links; using Bootstrap's `text-decoration-none` and `text-reset` allows these links to remain visual clones of the original text while gaining functionality.
**Action:** Always audit generic links for context and ensure contact information is interactive, especially for mobile users.
