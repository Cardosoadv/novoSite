# Palette's UX Journal - Cardoso & Bruno

## 2025-05-14 - Implement Skip to Content link
**Learning:** For single-page applications with fixed navigation bars, a "Skip to Content" link is essential for keyboard and screen reader users to bypass repetitive navigation links.
**Action:** Always implement a visually hidden link that becomes visible on focus, targeting the main content area with `tabindex="-1"`.
