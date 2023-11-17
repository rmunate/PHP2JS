---
title: Installation
editLink: true
outline: deep
---

## Installation

Installing **QuickRequest** in Laravel projects is a simple process. Include the following import statement in the HEAD section of your project:

```html
<head>
    <!-- ... -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/gh/rmunate/PHP2JS@4/src/JS/QuickRequest/QuickRequest.min.js"></script>
    <!-- ... -->
</head>
```

Take note that we have created a `<meta>` tag containing a valid token for requests to the Laravel backend. This is essential as QuickRequest utilizes this value in the required requests. This approach to working with the token is documented in Laravel's official documentation [X-CSRF-TOKEN](https://laravel.com/docs/10.x/csrf#csrf-x-csrf-token).

Alternatively, you can download the JS file to your project and host it locally in the public folder. Subsequently, invoke it from there:

```html
<head>
    <!-- ... -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('QuickRequest.min.js') }}"></script>
    <!-- ... -->
</head>
```