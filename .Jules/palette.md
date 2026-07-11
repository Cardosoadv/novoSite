## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-20 - [Brand-consistent Actionable Contact Links]
**Learning:** When converting static contact text to `tel:` or `mailto:` links in a brand-heavy UI, Bootstrap's `text-reset` and `text-decoration-none` are essential to prevent the browser's default link blue from clashing with the brand's gold/muted palette (`--gold`).
**Action:** Use these utility classes for all new interaction-layer links to maintain visual fidelity while improving mobile UX.
