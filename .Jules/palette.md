## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-22 - [Actionable Contact Links]
**Learning:** Improving mobile usability and accessibility can be as simple as wrapping static contact information in `tel:` and `mailto:` links. This allows users to initiate communication directly from the interface with a single tap.
**Action:** Always audit contact information for interactivity and use standard protocols to make them actionable without breaking visual design.
