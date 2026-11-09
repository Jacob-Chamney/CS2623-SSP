# CS2623 Week 4 Copilot Notes

<!--toc:start-->

- [CS2623 Week 4 Copilot Notes](#cs2623-week-4-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [SSP07 — Ex 11-1 (Arrays)](#ssp07--ex-11-1-arrays)
  - [SSP07 — Ex 15-1 (Regex/Exceptions)](#ssp07--ex-15-1-regexexceptions)

<!--toc:end-->

## Overall Experience

- I used the Chapter 11 and 15 starters as the baseline and checked Copilot's
  suggestions against the assignment's PHP 8 and security requirements. Most of
  the changes were small: short array syntax, strict comparisons, arrow
  functions, escaping every dynamic value, and making the exception hierarchy
  specific before broad.

- The table under each exercise records whether Copilot's suggestion was
  accepted, rejected, or improved.

## SSP07 — Ex 11-1 (Arrays)

| Suggestion                                          | Action   | Reason / Improvement                                                     |
| --------------------------------------------------- | -------- | ------------------------------------------------------------------------ |
| `array()` for `$fruits` declaration                 | Improved | Changed to `[]` short array syntax per PHP 8 standard                    |
| `in_array($search, $fruits)` without third argument | Improved | Added `true` for strict type comparison                                  |
| `array_filter` with an anonymous function           | Improved | Replaced with arrow function `fn($f) => strlen($f) >= 6`                 |
| `foreach` echo without escaping                     | Rejected | Added `htmlspecialchars()` / `e()` to all echoed values — XSS prevention |
| Price output with direct echo                       | Improved | Wrapped with `number_format((float) $price, 2)` for currency formatting  |
| `sort($fruits)` mutating the original array         | Improved | Sorted a copy so the original list stays intact                          |

## SSP07 — Ex 15-1 (Regex/Exceptions)

| Suggestion                                            | Action   | Reason / Improvement                                                              |
| ----------------------------------------------------- | -------- | --------------------------------------------------------------------------------- |
| Custom email regex pattern                            | Rejected | `filter_var(FILTER_VALIDATE_EMAIL)` is RFC-compliant; custom regex is fragile     |
| `strip_tags()` in output section                      | Rejected | `strip_tags()` is not XSS protection; replaced with `htmlspecialchars()`          |
| `addslashes()` for DB safety                          | Rejected | Must use PDO prepared statements; `addslashes()` is insufficient                  |
| `catch (Exception $e)` as first catch                 | Improved | Reordered: `FormatException`, then `ValidationException`, then `RuntimeException` |
| `htmlspecialchars()` on `$e->getMessage()`            | Accepted | Correctly applied escaping to exception message output                            |
| `nl2br()` directly on message                         | Improved | Changed to `nl2br(htmlspecialchars(...))` so escaping happens first               |
| `filter_var($age, FILTER_VALIDATE_INT)` without range | Improved | Added `min_range` 1 and `max_range` 120                                           |
| Exception classes in one file                         | Improved | Split into separate files and added a namespace                                   |
