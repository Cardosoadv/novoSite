## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Actionable Contact Info and Descriptive Links]
**Learning:** Making phone/email text actionable with `tel:` and `mailto:` links is a major mobile UX win. To maintain visual design while adding these links, the combination of Bootstrap's `text-decoration-none` and `text-reset` is highly effective. Additionally, providing `aria-label` context for generic "View Details" links is a simple but critical accessibility requirement for screen reader navigation.
**Action:** Always audit contact info for actionability and generic links for descriptive context.
