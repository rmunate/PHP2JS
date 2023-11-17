---
title: Share Existing PHP Variables
editLink: true
outline: deep
---

# Share Existing PHP Variables with JavaScript

The main directive of the PHP2JS Library is `@PHP2JS_VARS()`. It allows you to share all existing PHP variables with JavaScript. This means that you will pass to JavaScript both the values returned by the controller and the values of the variables you have created in the Blade view.

**That's right!** If you have defined loops and other statements in the front-end, you will have access to all of this in JavaScript. This is extremely useful.

```blade
// Default PHP2JS Alias
@PHP2JS_VARS() 

// With Custom Alias
@PHP2JS_VARS('__PHP')
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::