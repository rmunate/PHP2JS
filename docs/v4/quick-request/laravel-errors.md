---
title: Laravel Errors
editLink: true
outline: deep
---

# Errors

Now let's see how we can handle errors that occur during the processing of our request by the Laravel backend. Whether it's due to FormRequest, Validator, Exceptions, or any other source.

It is essential to receive a standardized response for the errors that occur because it is not common to create customizations for each request to the backend for possible generated errors.

For this, QuickRequest always returns the same error structure, regardless of whether errors are thrown in our code, caught in catch blocks, or thrown as exceptions in the framework.

Below is the structure that the value passed to the `error` function looks like:

```javascript
QuickRequest().get({ 
    //...
    error: function(err){
        console.log(err);
    },
    //...
});
```

Browser Console Output:

```shell
{
    "data": {
        "errors": {
            "Exception": [
                "Class \"App\\Http\\Controllers\\Records\" not found"
            ]
        },
        "message": "Exception"
    },
    "success": false,
    "code": 500
}
```

Where,
- `success`: always `FALSE`.
- `code`: contains the error code `419`, `500`, etc.

The `data` property will always contain two properties:
- `message`: This property contains the main error.
- `errors`: contains an object where each property has an array of different errors related to the same issue.

An important thing is how you should return errors from controllers to make reading from the front end more convenient:

```php
try {
    
    //...

} catch (\Throwable $th) {

    return response()->json([
        "Exception" => $th->getMessage(),
        // "Error 2" => "Message Error",
        // "Other Errors" => [
        //     'Sub Message Error 1',
        //     'sub Message Error 2'
        // ],
    ], 500);

}
```

Simply, if you notice, it's an indexed array.

**Convert Them to an Array**

If you need to work with an array instead of an object, perhaps to iterate and print errors in a list, you may find it convenient to use `QuickRequestErrors`. It's a simple utility to convert the error object into an array of objects.

Executing this:

```javascript
QuickRequest().get({ 
    //...
    error: function(err){
        console.log(
            QuickRequestErrors.setErrors(err.data.errors).toArray()
        );
    },
    //...
});
```

Now you'll get the following output:

```shell
[
    {
        "Exception": [
            "Class \"App\\Http\\Controllers\\Record\" not found"
        ]
    }
]
```

You might prefer a flattened array; you can achieve it easily like this:

```javascript
QuickRequest().get({ 
    //...
    error: function(err){
        console.log(
            QuickRequestErrors.setErrors(err.data.errors).toArrayflatten()
        );
    },
    //...
});
```

Now the output is clearer and easier to handle with a loop:

```shell
[
    {
        "Exception": "Class \"App\\Http\\Controllers\\Record\" not found"
    }
]
```