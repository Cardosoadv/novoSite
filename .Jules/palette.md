## 2025-05-15 - [Skip to Content implementation]
**Learning:** In projects using Bootstrap, the `visually-hidden-focusable` class is a reliable way to implement "Skip to Content" links without adding custom CSS, though brand focus styles should still be respected.
**Action:** Always check for existing utility classes (like Bootstrap's accessibility helpers) before writing custom styles to keep PRs under the 50-line limit.

## 2026-07-05 - [Actionable Contact Links & ARIA Labels]
**Learning:** When implementing `tel:` links for Brazilian numbers, including the international prefix `+55` ensures compatibility across all apps. Using Bootstrap utility classes `text-decoration-none` and `text-reset` allows making contact info actionable without disrupting the premium visual design. Descriptive `aria-label`s on generic "Ver Detalhes" links are essential for screen reader context in multi-card layouts.
**Action:** Use international prefixes for `tel:` links and maintain visual consistency with `text-reset` for contact info links. Always provide subject context in `aria-label`s for repetitive CTA links.
