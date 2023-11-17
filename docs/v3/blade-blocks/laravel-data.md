---
title: Share Framework Information
editLink: true
outline: deep
---

# Share Framework Information

This directive allows you to obtain some data inherent to the framework. In many cases, it helps to determine if the application's debugger is active to perform certain actions from JavaScript. You may find more utilities for this.

```blade
// Default PHP2JS Alias
@PHP2JS_FRAMEWORK() 

// With Custom Alias
@PHP2JS_FRAMEWORK('__PHP')
```

Object in JavaScript:

```javascript
{
	version:        // Laravel version in use
	environment: {
		name:       // Application name from ENV
		debug:      // Application's Debug mode state
		context:    // Environment in which it runs according to ENV
		url:        // Application's URL set in ENV
	}
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::