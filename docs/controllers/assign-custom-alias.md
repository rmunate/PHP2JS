---
outline: deep
---

# Assign a Unique Alias in JavaScript

By default, the package allows variables returned from the backend to be accessible in the JavaScript context through the constant `PHP2JS`. However, you have the flexibility to assign it a different name, one that is more descriptive or in line with its usage. For example:

- __PHP
- __Laravel
- __Back
- __MyAlias

## How to Assign a Custom Name?

Simply, as an argument of the `->toJS()` method, you will provide the name of the constant you wish to use. Note that this name will be reserved from this point on, and you will not be able to redeclare the constant in your JavaScript files.

```php
class YourController extends Controller
{
	public function index()
	{
		return view('welcome')->with([
			'name' => 'Raul Uñate'
		])->toJS("__PHP");
	}
}
```

Now you can access the values through this constant in JavaScript:

```javascript
let name = __PHP.vars.name;
// 'Raul Uñate'
```