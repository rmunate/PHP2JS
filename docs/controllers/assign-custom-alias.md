---
title: Customize JavaScript Alias
editLink: true
outline: deep
---

# Customize JavaScript Alias

By default, the package provides access to backend variables in the JavaScript context through the constant `PHP2JS`. However, you can customize this alias to better suit your needs or align with its purpose. For instance:

- __PHP
- __Laravel
- __Back
- __MyAlias

## Assigning a Custom Alias

### Method `->toJS()`

Simply specify the desired constant name as an argument of the `->toJS()` method. Keep in mind that this name becomes reserved and cannot be redeclared in your JavaScript files.

```php
class YourController extends Controller
{
    public function index()
    {
        $event = "Apollo 11 Moon Landing";

        return view('welcome')->with([
            'event' => $event
        ])->toJS("__PHP");
    }
}
```

Now access the values using this constant in JavaScript:

```javascript
let event = __PHP.data.event;
// 'Apollo 11 Moon Landing'
```

### Method `->toStrictJS()`

```php
class YourController extends Controller
{
    public function index()
    {
        $spacecraft = "Lunar Module Eagle";
        $event = "Apollo 11 Moon Landing";

        return view('welcome')->with([
            'spacecraft' => $spacecraft
        ])->toStrictJS([
            'event' => $event
        ], "__PHP");
    }
}
```

Now in JavaScript:

```javascript
let event = __PHP.data.event;
// 'Apollo 11 Moon Landing'
```

Customizing the JavaScript alias provides flexibility, allowing you to integrate the package seamlessly with your Laravel application while aligning with your coding preferences.