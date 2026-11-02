# CS2623 Week 3 Copilot Notes

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
