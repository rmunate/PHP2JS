---
outline: deep
---

# Share PHP Information

This directive allows you to obtain some data inherent to the version of PHP in use. This directive can be used for systems where multiple PHP versions are allowed. Only use it if you have a specific use case for it.

```blade
// Default PHP2JS Alias
@PHP2JS_PHP() 

// With Custom Alias
@PHP2JS_PHP('__PHP')
```

Object in JavaScript:

```javascript
{
	id:                     // PHP Version ID
	version:                // PHP version in use
	release:                // Current PHP release
	serverSoftware:         // Web server software currently executing the script
	serverOperatingSystem:  // Operating System on which PHP is running
	extensions:             // Enabled PHP extensions
	clientLanguage:         // Enabled Client Language
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::