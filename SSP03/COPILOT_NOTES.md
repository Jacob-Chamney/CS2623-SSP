# CS2623 Week 2 Copilot Notes

<!--toc:start-->

- [CS2623 Week 2 Copilot Notes](#cs2623-week-2-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [Accepted](#accepted)
  - [Rejected](#rejected)
  - [Improved](#improved)
  - [Additional Notes](#additional-notes)

<!--toc:end-->

## Overall Experience

- The assignments were straightforward, but deploying them introduced a steep
  learning curve. Copilot was helpful for generating code snippets, but I had to
  carefully vet its suggestions to ensure they aligned with the specific
  requirements and the legacy server environment.

- I refactored my entire codebase to make maintenance easier and to clean up the
  structure. By moving HTML and CSS to root folders (`/CSS/` and `/PHP/`), I
  consolidated shared assets, which makes navigation and global styling much
  easier to manage. However, this required me to learn how to properly route
  absolute paths (`dirname(__DIR__)`.

## Accepted

- I accepted many changes from Copilot, such as:

  - HTML and CSS refactoring, including name changes that made the code more
    readable and maintainable.

  - Variable name recommendations. Copilot generally suggested boilerplate that
    sped up the process of writing standard code.

  - Standard structural patterns for the DateTime API, such as initializing the
    timezone and using `diff()` to calculate intervals.

## Rejected

- Copilot rejections:

  - Copilot suggested a `match` statement instead of an `if/else` chain. Since
    the assignment specifically called for conditional logic and I needed to
    maintain compatibility, I rejected the `match` suggestion.

  - Copilot frequently suggested newer PHP features that are completely
    incompatible with the Apollo server (which runs PHP 5.5). I rejected
    `declare(strict_types=1);`, `str_contains()`, and array destructuring in
    `foreach` loops (e.g., `as [$a, $b]`), opting instead for
    `strpos() !== false` and standard index access to ensure the code wouldn't
    crash.

## Improved

- A major improvement is that Copilot usually doesn't suggest the
  `htmlspecialchars()` function to escape HTML characters and help prevent
  **XSS**. I had to manually add a helper function to the codebase to ensure
  that the code is secure and follows best practices.

```php
function e($string)
{
    echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
```

- By using this function, I can ensure that any user input is properly escaped,
  and Copilot now even suggests it automatically when I type `e(`. This is a
  great security improvement!

- I also improved the CSS architecture. I refactored the table styles from
  hardcoded IDs (`#weekly-planner`) to reusable classes (`.data-table`). This
  allowed me to apply the same clean, centered layout to the new string
  functions table without duplicating code.

## Additional Notes

- I am using LazyVim with the `copilot.vim` plugin. I have found that
  `copilot.vim` is a great tool for improving my coding skills and productivity,
  providing suggestions that help me write code faster and more efficiently.
  However, I don't have the chat feature set up yet, so I can't ask it to write
  a `.gitignore` file for me.

- Deployment required extra troubleshooting. Because of aggressive browser
  caching on the Apollo server, I had to learn how to force hard refreshes
  (`Ctrl + F5`).
