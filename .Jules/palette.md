## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2024-05-23 - [Navbar ARIA Synchronization]
**Learning:** For mobile navigation toggles in Bootstrap-based Vue apps, ensuring manual synchronization of 'aria-controls' and 'id' is necessary when the framework's data-attributes are bypassed by custom click handlers.
**Action:** Always verify that 'navbar-toggler' elements have 'aria-controls' mapping to the collapsible container's 'id'.
