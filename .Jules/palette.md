## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-07-30 - [Actionable contact detail links]
**Learning:** Wrapping plain-text phone numbers and email addresses in semantic `tel:` and `mailto:` links greatly improves mobile UX and communication workflows. By utilizing Bootstrap's `text-decoration-none` and `text-reset` utility classes, we can make these links fully actionable without introducing any custom CSS or breaking the established brand aesthetics.
**Action:** Always include international country codes (e.g., `+55` for Brazil) in `tel:` links to ensure cross-device/cross-app compatibility, and supply descriptive `aria-label` attributes to make the clickable interactive elements fully accessible to screen readers.
