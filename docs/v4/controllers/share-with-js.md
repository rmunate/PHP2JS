---
title: Sharing Values with JavaScript
editLink: true
outline: deep
---

# Sharing Values with JavaScript

After grasping the concepts explained on the previous page, we will delve into the utilization of any of the four options mentioned earlier to share the variables returned to the view with JavaScript.

Upon installing this package, you gain access to the `->toJS()` method. This method facilitates the direct sharing of all variables passed to the view with scripts written in both the same Blade view file and external JavaScript files added using the syntax:

```html
<script src="{{ asset('myScript.js') }}"></script>
```

Consider the following example:

```php
class YourController extends Controller
{
    public function index()
    {
        return view('welcome')->with([
            'moonLandingDate' => '1969-07-20'
        ])->toJS();
    }
}
```

Remember, you can utilize any of the four methods for passing variables to the view as explained on the previous page.

The provided code enables you to promptly access the variables returned from the controller in your JavaScript scripts through a constant named `PHP2JS`.

```javascript
let moonLandingDate = PHP2JS.data.moonLandingDate;
// '1969-07-20'
```

:::info Important!
Values will be shared with scripts written within `<script>...</script>` tags or imported via `<script src="..."></script>` within the `<body>` of the HTML.
:::