---
outline: deep
---

# Share URL Data

This directive allows you to pass an object with the data of the currently used URL to JavaScript. The object will allow you to access the values similar to when you send a request to the server.

```blade
// Default PHP2JS Alias
@PHP2JS_URL() 

// With Custom Alias
@PHP2JS_URL('__PHP')
```

Object in JavaScript:

```javascript
{
	baseUrl:      // Base URL to be used for AJAX, Axios, Fetch requests, etc.,
	fullUrl:      // Complete URL with query arguments,
	uri:          // URI, the value that comes after the Domain name,
	parameters: {
		route:    // Parameters passed through Laravel's route (GET),
		get:      // Parameters sent via URL (Query) (GET),
		post:     // Parameters sent via (POST),
	},
	scheme:       // HTTP scheme in use,
	currentName:  // Name of the Route assigned from Laravel's routes,
	isSecure:     // Defines if it has SSL,
}
```

::: warning Remember!
You cannot use aliases that match constants already defined in the JavaScript context. So, if you have returned this same view sharing data with JavaScript, remember to use a different alias.
:::