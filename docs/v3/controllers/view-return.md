---
outline: deep
---

# Return View

In previous versions, we used to utilize the `Rmunate\Php2Js\Render`; class. This class offered various solutions through its own fluent methods to create responses for the frontend, making it easier to deliver variables to JavaScript. Although this approach is still functional and can be useful in situations where it has already been implemented or where you wish to use the class that will continue to be available, we now offer a simpler solution.

Instead of that, we leverage the return under the native `Illuminate\View\View` class of the Laravel framework, which significantly simplifies the process.

The following code shows how to return a view conventionally without sharing data with JS, a native way of the framework. It is essential to understand the various ways it can be used, as we depend on this to explain how values are shared with JavaScript.

## Using the `view` method with `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$name = 'PHP2JS';
		return view('welcome', compact('name'));
	}
}
```

## Using only the `view` method without `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$value = 'PHP2JS';
		return view('welcome', [
			'name' => $value
		]);
	}
}
```

## Using the `view` method, the "with" method, and `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$name = 'PHP2JS';
		return view('welcome')->with(compact('name'));
	}
}
```

## Using the `view` method, the "with" method without `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$value = 'PHP2JS';
		return view('welcome')->with([
			'name' => $value
		]);
	}
}
```