---
outline: deep
---

# Share Session User Information

This directive allows you to share session user data with JavaScript. We've included it by default because most platform users use it, but it's at your discretion. You'll have session user data in JavaScript. Don't worry, the user's database ID and sensitive information will not be exposed. The ID will be encrypted using Laravel's `Crypt::encrypt()` method.

```blade
// Default PHP2JS Alias
@PHP2JS_USER() 

// With Custom Alias
@PHP2JS_USER('__PHP')
```

Object in JavaScript:

```javascript
{
	id:                     // Encrypted ID
	name:                   // User's name
	email:                  // Email address
	...                     // All other non-sensitive data.
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::