---
title: Share Only Some Existing
editLink: true
outline: deep
---

# Share Only Some Existing PHP Variables with JavaScript.

The second main directive of the PHP2JS Library is `@PHP2JS_VARS_STRICT(['variable1','variable2'])`. It allows you to share only some existing PHP variables with JavaScript. This means that you will pass to JavaScript only the controlled values you need.

This is more than useful; you can securely pass only the data you need to the JavaScript context, avoiding passing unnecessary values.

```blade
// Default PHP2JS Alias
@PHP2JS_VARS_STRICT(['variable1','variable2'])

// With Custom Alias
@PHP2JS_VARS_STRICT(['variable1','variable2'], '__PHP')
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::