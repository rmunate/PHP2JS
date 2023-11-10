---
outline: deep
---

# Prebuilt Information Blocks

PHP2JS comes with prebuilt data blocks that we believe can provide added value in certain types of development. We have made certain blocks available, which we will show you in this section, and you can attach them to the view's return to share them with JavaScript. The `->attach()` method allows us to add this data to the View's return.

You can use the method BEFORE the `->toJS()` or `->toStrictJS()` methods, as shown in the example:

```php
class YourController extends Controller
{
	public function index()
	{
		return view('welcome')->with([
			'name' => 'Raul Uñate'
		])->attach('agent', 'url', 'csrf', ...)->toJS("__PHP");
	}
}
```

Let's look at the currently available values, and remember that you can contribute to the package by adjusting the currently available values or suggesting new ones.

## Block 'agent'

You can know from which device the connection is running, the browser in use, if it's a connection from a mobile device, the source IP address of the connection, and the port.

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

## Block 'url'

You can access URL-related data, query parameters, URI, base URL for server requests, etc.

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
	scheme:       // HTTP scheme in use.,
	currentName:  // Name of the Route assigned from Laravel's routes,
	isSecure:     // Defines if it has SSL,
}
```

## Block 'csrf'

Returns a valid token for requests from JavaScript, allowing Ajax, Axios, Fetch requests to include the token in the payload.

```javascript
{
	token:          // Valid token for server requests via Laravel's Request,
	tokenCookie:    // Token delivered via Cookie from the server,
}
```

## Block 'framework'

Returns information regarding the framework in use, such as the version and non-sensitive values from the ENV.

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

## Block 'php'

Returns information about the PHP version in use and server details.

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

## Block 'user'

Returns information about the user in session. The ID is encrypted to avoid displaying sensitive information, and data such as passwords and timestamps are not included.

```javascript
{
	id:                     // Encrypted ID
	name:                   // User's name
	email:                  // Email address
	...                     // All other non-sensitive data.
}
```

::: tip **How to Access Them?**

Under the same alias that you used in the `->toJS("__PHP")` method or in the `->toStrictJS([...], "__PHP")` method, you can access them from JavaScript. For example, if you want to access user information, you can do it like this: `__PHP.user`

:::