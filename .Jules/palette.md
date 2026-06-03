## 2025-05-14 - Accessibility and Navigation Enhancements
**Learning:** Standard accessibility patterns like "Skip to Content" links and descriptive ARIA labels significantly improve the experience for keyboard and screen reader users without affecting the visual design. Dynamic form feedback should always use ARIA live regions to ensure assistive technologies announce changes.
**Action:** Implement "Skip to Content" links in main layouts and provide context-rich aria-labels for generic actions like "Read More" or "Delete". Use `role="status"` or `role="alert"` for asynchronous form feedback.
