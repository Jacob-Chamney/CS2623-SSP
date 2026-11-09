# CS2623 Week 4 Copilot Notes

<!--toc:start-->

- [CS2623 Week 4 Copilot Notes](#cs2623-week-4-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [SSP06 — Ex 21-2 (Auth)](#ssp06--ex-21-2-auth)
  - [SSP06 — Ex 23-1 (Shopping Cart)](#ssp06--ex-23-1-shopping-cart)

<!--toc:end-->

## Overall Experience

- This section focused on session security and the cart flow. Copilot was
  useful for boilerplate, but I had to add session regeneration, password
  verification, input filtering, the auth guard on the cart, and the
  remove/clear controls.

- The table under each exercise records whether Copilot's suggestion was
  accepted, rejected, or improved.

## SSP06 — Ex 21-2 (Auth)

| Suggestion | Action | Reason / Improvement |
|---|---|---|
| `md5()` or `sha1()` for password hashing | Rejected | Insecure — used `password_hash(PASSWORD_DEFAULT)` only |
| `session_start()` without `session_regenerate_id()` | Improved | Added `session_regenerate_id(true)` after successful login |
| Direct `$_POST['username']` access | Improved | Replaced with `filter_input(INPUT_POST, ...)` for sanitization |
| Hardcoded comparison: `$pw === 'secret'` | Rejected | Must use `password_verify()` with hashed password |
| `session_destroy()` on logout | Accepted | Correctly used `session_destroy()` + redirect pattern |
| Remember-me storing the password | Rejected | Stored only the username in an HttpOnly cookie for 30 days |
| No login attempt limit | Improved | Added `$_SESSION['attempts']` and locked after 3 failures |
| `date()` for login time | Improved | Used `DateTime` with `America/Chicago` for correct local time |

## SSP06 — Ex 23-1 (Shopping Cart)

| Suggestion | Action | Reason / Improvement |
|---|---|---|
| `$_SESSION['cart'] = $_SESSION['cart'] ?? []` | Improved | Shortened to `??=` assignment operator (PHP 8) |
| `(int)$_POST['product_id']` direct cast | Improved | Replaced with `filter_input(FILTER_VALIDATE_INT)` |
| Price output with raw echo | Improved | Wrapped with `number_format($price, 2)` for currency formatting |
| Session without `session_start()` | Rejected | `auth.php` starts the session and guards the cart page |
| No auth check on cart page | Improved | Added `require '../SSP06_21_2/auth.php'` to restrict the cart |
| `$_SESSION['cart'][$id]++` without initialization | Improved | Used `($_SESSION['cart'][$id] ?? 0) + 1` |
| No remove/clear controls | Improved | Added remove-one logic and `cart_clear.php` |
