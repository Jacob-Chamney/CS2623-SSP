# CS2623 Week 2 Copilot Notes

<!--toc:start-->

- [CS2623 Week 2 Copilot Notes](#cs2623-week-2-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [Accepted](#accepted)
  - [Rejected](#rejected)
  - [Improved](#improved)

<!--toc:end-->

## Overall Experience

- Server constraints were a major hurdle this week. The Apollo server is running
  PHP 5.5, which is significantly older than the PHP 8 environment the
  modernized assignments were designed for. This required constant vigilance to
  avoid newer syntax and functions.

- Restructuring the project to use a centralized root folder for CSS and PHP
  includes was a massive improvement for maintainability, but it broke all
  relative paths. I had to spend time learning how to properly route absolute
  paths on the server.

## Accepted

- I accepted many changes from Copilot such as :

  - Standard boilerplate for the DateTime API, specifically the pattern for
    initializing timezones and using `diff()` to calculate intervals.

  - Suggestions for centering layout elements, like wrapping specific sections
    in a `<div class="center-text">` to override default left-aligned text.

## Rejected

- Copilot rejections :

  - Copilot kept suggesting `str_contains()` for the string exercises, and
    `declare(strict_types=1);` at the top of the DateTime file. Both are PHP
    7.0/8.0+ features. I rejected them and used `strpos() !== false` to maintain
    compatibility with the PHP 5.5 Apollo server.

  - Copilot suggested `foreach ($array as [$a, $b])` for array destructuring.
    This is PHP 7.1+ syntax and caused a parse error on the server. I rejected
    it and used standard index access (`$row[0]`).

## Improved

- A major improvement was refactoring the `table.css` file. Originally, the CSS
  was hardcoded to an ID (`#weekly-planner`). I changed it to target a reusable
  class (`.data-table`). This allowed me to apply the exact same clean styling
  to the new string functions table in SSP04 without duplicating code.

- I also learned how to bypass aggressive browser caching on the Apollo server
  by appending a version query string (`href="main.css?v=2"`) to my CSS links.
  This solved a frustrating issue where my uploaded code changes were not
  reflecting on the live site.

## Additional Notes

- Using `dirname(__DIR__)` in my PHP `require_once` statements was the only
  reliable way to link to the root `/PHP/` folder from inside subfolders like
  `/SSP04/`.
