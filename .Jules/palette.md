## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2025-05-16 - [Actionable Contact & Form Feedback]
**Learning:** To maintain the "Premium" visual style of the application while improving accessibility, actionable contact links (tel/mailto) should use Bootstrap's `text-decoration-none` and `text-reset` classes. For dynamic form feedback, `aria-live="polite"` on success containers and `role="alert"` on error lists ensure immediate AT notification without layout shifts.
**Action:** Apply these utility classes and ARIA roles to all contact points and form interactions to balance high-end design with accessibility compliance.
