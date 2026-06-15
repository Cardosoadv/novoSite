## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-15 - [Accessible Filter Buttons]
**Learning:** Visual-only active states for category filters (like `.active` classes) are insufficient for screen readers. Using `:aria-pressed` tied to the application state ensures that "toggle" or "choice" interactions are correctly announced.
**Action:** When implementing filter or toggle buttons, always synchronize the ARIA state (`aria-pressed` or `aria-selected`) with the component's underlying reactive state.
