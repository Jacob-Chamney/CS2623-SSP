# CS2623 Week 1 Copilot Notes

<!--toc:start-->

- [CS2623 Week 1 Copilot Notes](#cs2623-week-1-copilot-notes)
  - [Overall Experience](#overall-experience)
  - [Accepted](#accepted)
  - [Rejected](#rejected)
  - [Improved](#improved)
  - [PHP Output and Escaping](#php-output-and-escaping)

<!--toc:end-->

## Overall Experience

Throughout the assignment i followed the instructions as closely as possible,
often finding sections a bit confusing? Such as the main.css file, which was
presented as a comment block with a note stating that copilot will suggest css
rules. Using this note i was able to get copilot to suggest some css rules but
often the suggestions were not what was desired. I found that simply making an
inline note and going to the next line gave copilot a much better chance of
suggesting what was desired.

## Accepted

Using the technique above i accepted many css suggestions from copilot, such as
rounded corners, colors, font sizes, and alignment. These turned out to be
stylistic choices that were not required but that i liked and wanted to keep.

I also accepted much of the boilerplate code from the simple <!DOCTYPE html>
tag. This made it much easier to get through the assignment without having to
worry about the basic structure of the html file.

## Rejected

The main suggestion i rejected was for the loop. Copilot completely failed to
suggest anything close to what the assignment required. I ended up just writing
the loop myself following the structure in the example code provided. I
repeatedly got handed the incorrect syntax for the loop, and it even appeared to
have trouble with the variables.

## Improved

I ended up accepting many css changes from copilot, but i also made many changes
to those suggestions. Sometimes it was almost what i wanted but contained some
extra styling that was not necessary.

I also improved many suggestions that were correct but didn't make use of the
htmlspecialchars() function thus preventing security issues.

## PHP Output and Escaping

Static html can be echoed directly from the server. This is useful for serving
simple web pages or static content. User-supplied text must be escaped with
htmlspecialchars() to prevent XSS attacks.
