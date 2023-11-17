---
outline: deep
---

# Return View

The following code demonstrates how to return a view conventionally without sharing data with JS, in a native manner as outlined by the framework. It is crucial to understand the various ways a view can be returned with data, as we rely on this to explain how values are shared with JavaScript.

## Compact Shape 1
Using the `view` method with `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$library = 'PHP2JS';
		return view('welcome', compact('library'));
	}
}
```

## Compact Shape 2
Using only the `view` method without `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$library = 'PHP2JS';
		return view('welcome', [
			'library' => $library
		]);
	}
}
```

## Fluid Methods 1
Using the `view` method, the "with" method, and `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$library = 'PHP2JS';
		return view('welcome')->with(compact('library'));
	}
}
```

## Fluid Methods 2
Using the `view` method, the "with" method without `compact`

```php
class YourController extends Controller
{
	public function index()
	{
		$library = 'PHP2JS';
		return view('welcome')->with([
			'library' => $library
		]);
	}
}
```