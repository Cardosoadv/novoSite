## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Contact Actionability & Form Feedback]
**Learning:** To make `tel:` and `mailto:` links actionable without changing their visual style in a premium design system, the combination of Bootstrap's `text-decoration-none` and `text-reset` is highly effective. Additionally, using `aria-live="polite"` on success messages and `role="alert"` on error lists ensures that dynamic form feedback is immediately announced by screen readers without requiring a page reload.
**Action:** Always wrap contact information in semantic links and use live regions for asynchronous form feedback to ensure a smooth, accessible experience.
