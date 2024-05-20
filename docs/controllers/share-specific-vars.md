---
title: Share Specific Values with JavaScript
editLink: true
outline: deep
---


# Share Specific Values with JavaScript

If you need to share only particular values returned to the view with JavaScript, rather than all variables, the `->toStrictJS()` method provides a more targeted approach. This method functions similarly to Laravel Framework's `->with()` method.

Let's explore an example where distinct values are shared with both the view and JavaScript.

```php
class YourController extends Controller
{
    public function index()
    {
        $astronauts = [
            'Neil Armstrong',
            'Buzz Aldrin',
            'Michael Collins'
        ];

        $spacecraft = "Lunar Module Eagle";
        $event = "Apollo 11 Moon Landing";

        return view('welcome')->with([
            'astronauts' => $astronauts
        ])->toStrictJS([
            'spacecraft' => $spacecraft,
            'event'      => $event,
        ]);
    }
}
```

In this example, only the values of `spacecraft` and `event` are shared with JavaScript.

```javascript
let spacecraft = PHP2JS.data.spacecraft;
// 'Lunar Module Eagle'

let event = PHP2JS.data.event;
// 'Apollo 11 Moon Landing'
```

This method provides a more granular control over the information shared with JavaScript, ensuring a streamlined integration of specific values between your Laravel application and the client-side scripts.