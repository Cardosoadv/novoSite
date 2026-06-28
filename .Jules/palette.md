## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2024-06-28 - [Accessibility and Actionability improvements]
**Learning:** Repetitive generic links like "Ver Detalhes" can be made accessible by adding aria-label with context from nearby headers. Converting contact info to tel: and mailto: links with text-decoration-none text-reset improves mobile UX without affecting the desktop design.
**Action:** Always provide screen reader context for generic links and ensure contact information is actionable.
