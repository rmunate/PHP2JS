---
title: Share Connection Agent Data
editLink: true
outline: deep
---

# Share Connection Agent Data

This directive allows you to pass an object with connection agent data captured by the server to JavaScript. No JavaScript capture methods are used; all data is read and passed by the server to JavaScript.

```blade
// Default PHP2JS Alias
@PHP2JS_AGENT() 

// With Custom Alias
@PHP2JS_AGENT('__PHP')
```

Object in JavaScript:

```javascript
{
	identifier:  // Agent Registered From The Server,
	remote_ip:   // Remote IP address of the user's connection,
	remote_port: // Remote port of the user's connection,
	browser:     // Browser data in use (Name, Version, and Platform),
	isMobile:    // Validates if the connection is from a mobile device.
	OS:          // Operating system used to connect to the application.
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::