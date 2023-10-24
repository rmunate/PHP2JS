---
outline: deep
---

# Sharing Values with JavaScript

Understanding the previous page, we will now explain how you can use any of the four previous options to share the variables returned to the view with JavaScript.

Upon installing this package, you will now have access to the `->toJS()` method. This method allows all variables passed to the view to be directly shared with scripts written both in the same Blade view file and in external JavaScript files added using the syntax: 

```html
<script src="{{ asset('myFile.js') }}"></script>
```

Let's see an example:

```php
class YourController extends Controller
{
	public function index()
	{
		return view('welcome')->with([
			'name' => 'Raul Uñate'
		])->toJS();
	}
}
```

Remember that you can use any of the four ways to pass variables to the view explained in the previus page.

The above code allows you to immediately read the variables returned from the controller in your JavaScript scripts through a constant with the name `PHP2JS`.

```javascript
let name = PHP2JS.vars.name;
// 'Raul Uñate'
```

:::tip Security Tip

You can employ a best practice, which is to assign a different name to the constant that will be received in the JavaScript context. This is done to ensure that only developers or maintainers are aware of the means of entry for values returned by the backend.

**See Next Page =>**
:::

