## 2024-06-04 - [Accessibility] Skip to Content Link
**Learning:** Implementing a "Skip to Content" link is a critical accessibility requirement for keyboard users, allowing them to bypass repetitive navigation. Using `tabindex="-1"` on the target element ensures that focus is moved correctly even in browsers with inconsistent focus behavior on non-interactive elements.
**Action:** Always include a skip link in the main layout (`App.vue`) as the first focusable element for any project with a navigation menu.
