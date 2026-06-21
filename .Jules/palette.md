## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Actionable Contact Links]
**Learning:** Making phone numbers and emails actionable via `tel:` and `mailto:` links provides significant mobile UX benefits. Using `text-decoration-none` and `text-reset` utility classes allows this functionality to be added without disturbing the carefully crafted visual identity.
**Action:** Proactively identify static contact information and convert it to interactive links using non-intrusive styling.
