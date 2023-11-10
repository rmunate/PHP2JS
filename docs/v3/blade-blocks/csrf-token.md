---
outline: deep
---

# Share Valid Token

This directive is one of the most commonly used and allows you to have a valid Laravel token from the JavaScript context. The object will contain a valid token as well as the token delivered by a cookie from the server.

```blade
// Default PHP2JS Alias
@PHP2JS_CSRF() 

// With Custom Alias
@PHP2JS_CSRF('__PHP')
```

Object in JavaScript:

```javascript
{
	token:          // Valid token for server requests via Laravel's Request,
	tokenCookie:    // Token delivered via Cookie from the server,
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::