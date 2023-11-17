---
title: Exceptions
editLink: true
outline: deep
---

# Exceptions:

In case there is an error in the structure or processing of the data with QuickRequest, you will see an exception in the browser console like the following:

```shell
QuickRequest.js:27 ⚠ QuickRequestException ⚠ | Error: Could not find any form with the id AnyForm 
{
    "name": "Error",
    "message": "Could not find any form with the id AnyForm",
    "trace": [
        "Error: Could not find any form with the id AnyForm",
        "🔍 At: new QuickRequestException (http://laravel.com/QuickRequest.js:24:23)",
        "🔍 At: QuickRequestFetch.data (http://laravel.com/QuickRequest.js:489:23)",
        "🔍 At: QuickRequestFetch.send (http://laravel.com/QuickRequest.js:659:14)",
        "🔍 At: QuickRequestFetch.dispatch (http://laravel.com/QuickRequest.js:649:18)",
        "🔍 At: new QuickRequestFetch (http://laravel.com/QuickRequest.js:466:14)",
        "🔍 At: HTMLFormElement.funcEvent (http://laravel.com/QuickRequest.js:421:21)"
    ]
}
```

It will be very easy to identify the error that occurred, as well as view the error trace.