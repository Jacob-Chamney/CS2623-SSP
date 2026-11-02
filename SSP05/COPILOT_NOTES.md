# CS2623 Week 3 Copilot Notes

<!--toc:start-->

- [CS2623 Week 3 Copilot Notes](#cs2623-week-3-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [Accepted](#accepted)
  - [Rejected](#rejected)
  - [Improved](#improved)
  - [SSP05_1](#ssp05_1)
  - [SSP05_2](#ssp05_2)

<!--toc:end-->

## Overall Experience

## Accepted

- For `SSP05_ex1.php` I accepted the standard `filter_input()` skeleton for the
  seven fields, including the `FILTER_VALIDATE_EMAIL` and `FILTER_VALIDATE_INT`
  arguments.

- I also accepted the page structure Copilot filled in around the form, so the
  exercise matches the header, nav and footer used by the rest of the site.

- Copilot generated the whole six field form for `SSP05_ex2.php` from the
  comment listing the fields, including the product select with prices and the
  three `options[]` checkboxes.

- I accepted Copilot's suggestion to escape every value before it goes into the
  results block, which in this project means the `e()` helper that wraps
  `htmlspecialchars($val, ENT_QUOTES, 'UTF-8')`.

## Rejected

- Copilot used `$_POST['first_name']` directly instead of `filter_input()`. I
  rejected it because the assignment requires `filter_input()`, and it also
  returns null for a missing field instead of an undefined index warning.

- Copilot added `declare(strict_types=1);` at the top of the file. I rejected it
  because the server runs PHP 5.5, where it only produces an unsupported declare
  warning, so it is commented out with a note instead.

- Copilot wrote `isset($_POST['gift_wrap'])` once per checkbox in
  `SSP05_ex2.php`. I rejected that because the assignment needs the array with
  `FILTER_REQUIRE_ARRAY`, and the per box version has to be edited every time an
  option is added.

- Copilot used `FILTER_SANITIZE_STRING` in its example. I rejected it because it
  is deprecated since PHP 8.1, and it strips input instead of validating it.

## Improved

- Copilot wrote the defaults with `??`, which is PHP 7.0 and later. I improved
  those lines to `is_null()` checks so the page runs on the PHP 5.5 server (not
  really an improve but a fix).

- Copilot left the echoed values unescaped. I improved every output to go
  through the `e()` helper so submitted text cannot inject HTML.

- While debugging `SSP05_ex2.php` I used `print_r($_POST, true)` inside `<pre>`
  instead of Copilot's `var_dump($_POST)`, so the submitted fields were readable.
  That line was removed before finishing.

- Copilot put `nl2br()` straight on the instructions value. I improved it to
  `htmlspecialchars()` first, or the `<br>` tags it adds get escaped along with
  the user's text.

## SSP05_1

- `filter_input()` vs `$_POST`, as answered by Copilot Chat:

  > The difference between `filter_input` and `$_POST` in PHP lies in how they
  > handle input data and their intended use cases.
  >
  > **`$_POST`** is a superglobal array that contains data sent via the HTTP
  > POST method. You access form data directly by the field's `name` attribute
  > (`$firstName = $_POST['first_name'];`). It performs no validation or
  > sanitization, so you must validate and sanitize manually to prevent issues
  > like XSS or SQL injection.
  >
  > **`filter_input`** retrieves a specific external variable (from GET, POST,
  > COOKIE, and so on) and optionally applies a filter. It is part of the Filter
  > extension and lets you name the input source (`INPUT_POST`, `INPUT_GET`) and
  > apply filters such as `FILTER_VALIDATE_EMAIL` to ensure the data is in the
  > expected format.
  >
  > In summary, `$_POST` is direct access without filtering, while
  > `filter_input` is the more secure, flexible way to retrieve and validate
  > input.

## SSP05_2

- I wrote comments to steer Copilot. One says the checkbox array needs
  `FILTER_REQUIRE_ARRAY`, and a `why does the above line work?` question sits
  under the filter call, which Copilot answered inline as comments. The filter
  call and the `is_null()` checks that replaced `?? []` came out of those
  prompts.

- Copilot used `FILTER_DEFAULT` in that call. It is deprecated in PHP 8.5 and is
  only an alias of `FILTER_UNSAFE_RAW`, so I changed the comment to say
  `FILTER_UNSAFE_RAW` instead.
