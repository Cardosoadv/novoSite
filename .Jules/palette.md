## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-22 - [Accessibility for dynamic filters and contact info]
**Learning:** Using dynamic `:aria-pressed` on filter buttons and `:aria-label` for generic links like "Ler Artigo" provides critical context for screen reader users in content-heavy law firm sites. Converting static phone/email text to `tel:` and `mailto:` links significantly improves mobile usability without changing visual layout.
**Action:** Consistently apply `aria-pressed` to toggle buttons and ensure all contact information is actionable to meet modern accessibility and UX standards.
