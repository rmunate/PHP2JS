---
outline: deep
title: Usage
---

## Use

In the view, before calling the external JavaScript files, you must place the `@__PHP()` directive, it must be there only once.
This will make all variables returned by the server and declared in the view readable in all JavaScript files entered in the following lines of code.

```php
@__PHP()
<script src="{{ asset('js/myscript.js') }}"></script>
```