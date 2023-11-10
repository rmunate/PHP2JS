---
outline: deep
---

# Share Only Some Values with JavaScript

If you require sharing only specific values returned to the view with JavaScript, rather than all the variables, then it will be more convenient to use the `->toStrictJS()` method. This method works similarly to Laravel Framework's ->with() method.

Let's see an example where different values are shared with the view and JavaScript.

```php
class YourController extends Controller
{
	public function index()
	{
		// Remember that you can also use compact if you already have the variables defined.
		return view('welcome')->with([
			'package' => 'PHP2JS',
			'version' => '^3.8',
		])->toStrictJS([
			'link' => 'https://github.com/rmunate/PHP2JS'
		]);
	}
}
```

With this example, we are only sharing the value of the link with JavaScript.

```javascript
let name = PHP2JS.vars.link;
// 'https://github.com/rmunate/PHP2JS'
```

:::tip Security Tip
You can assign a different name to the constant that will be received in the JavaScript context, simply pass the desired name as the second argument to the method.

```php
->toStrictJS([
	'link' => 'https://github.com/rmunate/PHP2JS'
], "__PHP")
```

Now in Javascript:

```javascript
let name = __PHP.vars.link;
// 'https://github.com/rmunate/PHP2JS'
```
:::
