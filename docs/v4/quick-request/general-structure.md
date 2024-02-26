---
title: General Structure
editLink: true
outline: deep
---

# General Structure of QuickRequest

QuickRequest features a clean and easy-to-implement syntax designed to simplify executing requests to the Laravel backend without complications, excessive configurations, or an abundance of code lines.

Let's explore the simple structure of QuickRequest:

```javascript
QuickRequest().get({ 
    url: '/slug/1', 
    expect: 'JSON',
    before: function(){
        //...
    },
    success: function(res){
        //...
    },
    error: function(err){
        //...
    },
    after: function(full){
        //...
    },
});
```

Now, let's provide a more detailed explanation of the different possible configurations in QuickRequest().

## Methods

To define the method to use, simply use the corresponding method name as the opening method of the request configuration data:

```javascript
QuickRequest().get({...});
```

```javascript
QuickRequest().post({...});
```

```javascript
QuickRequest().patch({...});
```

```javascript
QuickRequest().put({...});
```

```javascript
QuickRequest().delete({...});
```

## Expect

With QuickRequest, you can easily handle three types of expectations commonly used in Laravel applications.

- **JSON** (Default): In this case, the backend (controller) is expected to return a valid JSON.

```javascript
QuickRequest().get({
    //...
    expect: "JSON"
    //...
});
```

In controllers, you should always use a return statement like the following:

```php
return response()->json($data, 200);
```

- **TEXT**: There may be moments when you expect to return plain text such as HTML or something similar required in your JS. In that case, configure QuickRequest as follows.

```javascript
QuickRequest().get({
    //...
    expect: "TEXT"
    //...
});
```

In controllers, you should use a return statement like the following:

```php
return response('<span>Content</span>');

//Or

return response('<span>Content</span>', 200)
        ->header('Content-Type', 'text/html');
```

Some other headers where TEXT should be expected.

| File Type        | Content-Type Header             |
|----------------- |---------------------------------|
| Plain Text       | `Content-Type: text/plain`      |
| HTML             | `Content-Type: text/html`       |
| CSS              | `Content-Type: text/css`        |
| JavaScript       | `Content-Type: text/javascript` |

- **BLOB**: It's common in Laravel applications to download files, images, Excel files, etc. For these scenarios, QuickRequest allows us to expect binaries and additionally provides an easy way to download files.

```javascript
QuickRequest().get({
    //...
    expect: "BLOB"
    success: function(res){

        // Download File.
        QuickRequestBlobs.setBlob(res.data)
                         .setName("Image")
                         .setExtension("jpeg")
                         .download();
    },
    //...
});
```

In controllers, you should use a return statement where you specify the headers corresponding to the type of file being returned:

```php
$pathToImage = public_path('image.jpeg');
$imageContents = file_get_contents($pathToImage);

return response($imageContents, 200)
            ->header('Content-Type', 'image/jpeg');
```

Here are some common headers:

| File Type                    | Content-Type Header                                                                       |
|------------------------------|-------------------------------------------------------------------------------------------|
| JPEG Image                   | `Content-Type: image/jpeg`                                                                |
| PNG Image                    | `Content-Type: image/png`                                                                 |
| GIF Image                    | `Content-Type: image/gif`                                                                 |
| BMP Image                    | `Content-Type: image/bmp`                                                                 |
| WebP Image                   | `Content-Type: image/webp`                                                                |
| SVG Image                    | `Content-Type: image/svg+xml`                                                             |
| PDF Document                 | `Content-Type: application/pdf`                                                           |
| Excel Spreadsheet (XLSX)     | `Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet`         |
| Word Document (DOCX)         | `Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document`   |
| PowerPoint (PPTX)            | `Content-Type: application/vnd.openxmlformats-officedocument.presentationml.presentation` |
| CSV (Comma-Separated Values) | `Content-Type: text/csv`                                                                  |
| XML                          | `Content-Type: application/xml`                                                           |
| ZIP Archive                  | `Content-Type: application/zip`                                                           |

## URL

QuickRequest expects the URL value to be what comes after the domain, meaning:

```javascript
/**
 * When working with Ajax or Axios, you need to 
 * pass the entire URL like this:
 */
const url = "https://sub.domain/custom-slug/10"

/**
 * When working with QuickRequest, you only need to include
 * what comes after the domain
 * In this case, what comes after:
 * https://sub.domain/
 */
const url = "/custom-slug/10"
```

In other words, the actual usage would be:

```javascript
QuickRequest().get({ 
    url: '/custom-slug/10',
    //...
});
```

## Payload

How to send values through QuickRequest().

You have two possible ways to do this, depending on whether you want to send form data or if you want to send an object with specific data to the backend.

**Send a Form:**

To send a form to the backend, you can use the following structure, where the value you put in the `form` property is the id of your form:

Your form must have the `id` assigned:

```html
<form id="myForm">
    <input type="text" name="name" id="name" placeholder="Your Name">
</form>
```

This `ID` should be the value of the `form` property:

```javascript
QuickRequest().post({ 
    //...
    form: 'myForm'
    //...
});
```

**Send Specific Data:**

If you don't want to send form data but instead want to send specific data, then it is more convenient to use the `data` property, where you can simply relate the data you expect to receive in your controller through an object.

```javascript

// Estatic Data
QuickRequest().post({ 
    //...
    data: {
        key1: 'value1',
        key2: 'value2',
    }
    //...
});

// Dinamic Data
QuickRequest().post({ 
    //...
    data: function () {
        return {
            key1: document.getElementById('value1').value,
            key2: document.getElementById('value1').value,
        };
    },
    //...
});
```

**Can I Send a Form and Additional Data?**

Yes, if your case is that you need to add some values to the form data, then you can use both properties at the same time:

```javascript
QuickRequest().post({ 
    //...
    form: 'myForm',
    data: function () {
        return {
            key1: document.getElementById('value1').value,
            key2: document.getElementById('value1').value,
        };
    },
    //...
});
```

Ensure that values are not overwritten when using the same name for an input within the `data` property.

## Headers

If you need to define specific headers in the request, you can easily do so using the `Headers` property. QuickRequest typically assigns headers automatically, but if you find it necessary, you can apply them manually.

```javascript
QuickRequest().post({ 
    //...
    headers: {
        'Content-Type': 'application/json'
    }
    //...
});
```

This allows you to customize headers as needed for your specific requests.

## Before the Request

If you need to perform any actions before sending the request to the backend, such as activating a spinner, displaying a preload on the web, showing notifications, or disabling buttons, you can easily achieve this with the `before` function:

```javascript
QuickRequest().post({ 
    //...
    before: function(){
        const buttonSubmit = document.getElementById('btn-submit');
        buttonSubmit.disabled = true;
    },
    //...
});
```
This method is not mandatory.
You can execute any type of action prior to sending the request.

## Successful Response

If the response is successful, you can retrieve the values from the response using the `success` function.

```javascript
QuickRequest().post({ 
    //...
    success: function(res){
        const data = res.data; //{[...]}
        const success = res.success; //true
        const httpStatusCode = res.code; //200
    },
    //...
});
```
This method is mandatory.
Within this block, you can perform all the actions that correspond to a successful response.

## Error Response

If an error occurs or the response is returned with an HTTP error code, then the response will be received through the `error` function. Here, you can access the list of errors generated and returned by the Laravel backend.

It's important to note that regardless of how errors are returned from the backend, you will always receive them in the same format. This ensures standardized error handling in JavaScript and addresses the lack of a consistent error return standard from the framework.

```javascript
QuickRequest().post({ 
    //...
    error: function(err){
        const errorMessage = err.data.message; // Main Exception Message
        const errorsList = res.data.errors; // List of errors
        const httpStatusCode = res.code; // 500 and others
    },
    //...
});
```

It's important but not mandatory that when returning errors from the Laravel backend, you always use the following indexed array format:

```php
try {
    
    //...

} catch (\Throwable $th) {

    return response()->json([
        "Exception" => $th->getMessage(),
        "Other Errors" => [
            'Error 1',
            'Error 2'
        ],
    ], 500);

}
```

## After the Request

Just as you have the ability to execute any action before sending the request to the backend, you can also perform any action after the request has been completed. In this function, you will have access to the response, whether it's successful or contains errors from the backend. This can be useful if you need these details to condition your actions.

```javascript
QuickRequest().post({ 
    //...
    after: function(full){
        const httpStatusCode = full.code;
        const dataOrErrors = full.data;
        const successOrFail = full.success;
    },
    //...
});
```

This method is not mandatory; if you don't need it, you can simply omit it.

## Using an Event

One interesting feature of QuickRequest is the ability to trigger a backend request based on the execution of an event.

Below, you will find two possible ways to execute a backend request only when a specific event occurs.

**Conventional Approach**

You can trigger an event in the conventional way provided by JavaScript and simply specify that QuickRequest makes the request only if the event is fulfilled.

```javascript
document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();

    QuickRequest().get({ 
        url: '/slug/1', 
        expect: 'JSON',
        success: function(res){
            //...
        },
        error: function(err){
            //...
        },
    });
    
});
```

**Simplified with QuickRequest**

The previous approach can be easily streamlined using QuickRequest's own methods. Here is the same scenario but more compact and in the QuickRequest style:

```javascript
QuickRequest().eventListener('submit','#myform').preventDefault().get({ 
    url: '/slug/1', 
    expect: 'JSON',
    success: function(res){
        //...
    },
    error: function(err){
        //...
    },
});
```

You should use the `preventDefault()` method only in cases where you need to prevent the default behavior of the event. It is common to use it in `submit` events to interrupt the default browser-triggered event and execute the JavaScript action.

## Disabling Events

How could I deactivate the events triggered by QuickRequest when needed?

Well, for this purpose, it's as simple as storing the action within a variable and then using a QuickRequest method to disable the associated events.

Here's how:

```javascript
// Activate the event
const submitForm = QuickRequest().eventListener('submit','#myform').preventDefault().get({ 
    url: '/slug/1', 
    expect: 'JSON',
    success: function(res){
        //...
    },
    error: function(err){
        //...
    },
});

// List events if needed
submitForm.getEvents();

// Deactivate the event
submitForm.removeEventListener();
```

## Requesting Confirmation

If you, for example, want to display a confirmation window before sending the request to the backend, QuickRequest can provide this solution. Through the `confirm` method, you can create the logic you need to ask the user for confirmation of the action to be performed. If this method returns `true`, the action will be executed; otherwise, no action will be taken.

```javascript
QuickRequest().eventListener('submit','#myform').preventDefault().confirm(function(){

    /**
     * You could, for example, use SweetAlert2 to request 
     * confirmation or something similar.
     * 
     * True execute the event, False stops it
     */
    return true;

}).get({ 
    url: '/slug/1', 
    expect: 'JSON',
    success: function(res){
        //...
    },
    error: function(err){
        //...
    },
});
```

## Other Options

If needed, you also have the following options available:

```javascript
QuickRequest().post({ 
    //...
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    //...
});
```

These are not commonly used for typical requests in Laravel monoliths. However, if you require any specific actions, you can apply them as needed.
