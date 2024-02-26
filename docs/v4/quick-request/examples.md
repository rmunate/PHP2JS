---
title: Examples
editLink: true
outline: deep
---

# Usage Examples

Next, we will explore some usage examples of QuickRequest to address any uncertainties that may arise regarding the previous page outlining the general structure of the solution.
## GET Method

Used to retrieve information from the server, it should be safe and idempotent. Data is sent through the URL (query parameters) and is suitable for read-only operations.

In simple terms, it is used to query data, download files, etc.

### Query Data

- Routes in `web.php`:

```php
Route::get('/record/{id}', [YourController::class, 'find']);
```

- Method in `YourController.php`:

```php
public function find($id)
{
    /**
     * Execute the corresponding actions.
     * In this example, a simple database query.
     */
    $record = Record::find($id);

    /**
     * Return the data as JSON.
     * Preferably use response()->json($data, 200);
     */
    return response()->json($record, 200);
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Considering that this value is retrieved from
 * somewhere in a JS variable.
 */
const idRecord = 10;

/**
 * Use the route structure created in web.php.
 */
QuickRequest().get({
    url: '/record/' + idRecord,
    success: function (res) {
        console.log("Successful Process, Data: ", res.data);
    },
    error: function (err) {
        console.error("Error: " + err.data.message);
    }
});
```

### Download File

- Routes in `web.php`:

```php
Route::get('/image/{name}', [YourController::class, 'findImage']);
```

- Method in `YourController.php`:

```php
public function findImage($name)
{
    /**
     * Execute actions.
     * In this example, search for an image
     * in the public folder.
     */
    $pathToImage = public_path($name . ".jpeg");
    $imageContents = file_get_contents($pathToImage);

    /**
     * Return the image as a "Binary Large Object" (Blob).
     * Important to define ->header('Content-Type', ?)
     */
    return response($imageContents, 200)->header('Content-Type', 'image/jpeg');
}
```

- `QuickRequest` Request

Now that you are receiving an image as a "Binary Large Object," let's easily download it with `QuickRequestBlobs`:

```javascript
const nameImage = 'LaravelLogo';

QuickRequest().get({
    url: '/image/' + nameImage,
    expect: 'blob', // Mandatory
    success: function (res) {
        /**
         * To download the file, simply
         * Use the QuickRequestBlobs object that facilitates
         * the action.
         */
        QuickRequestBlobs.setBlob(res.data)    // Always arrives at this position the blob
                         .setName("Test")      // Preferably without spaces.
                         .setExtension("jpeg") // Lowercase extension without the dot.
                         .download();
    },
    error: function (err) {
        console.error("Error: " + err.data.message);
    }
});
```

::: tip Reminder
In controllers, always use the `->header('Content-Type', '?')` method, where `?` will be the corresponding value according to the type of file you want to download.
:::

### Send Data

Although with the GET method, you can send various values to the backend, remember that it should only be used to query information. Under no circumstances should it be used to insert data into the database or perform any other type of action.

- Routes in `web.php`:

```php
Route::get('/record/{type}', [YourController::class, 'groups']);
```

- Method in `YourController.php`:

```php
public function groups($type, Request $request)
{
    /**
     * Receive $type value from the URL
     * and $request from the URL Query.
     */
    $groups = Record::where('type', $type)
                    ->where("owner", $request->owner)
                    ->groupBy($request->tag);

    /**
     * Return the data as JSON.
     * Preferably use response()->json($data, 200);
     */
    return response()->json($groups, 200);
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Considering that this value is retrieved from
 * somewhere in a JS variable.
 */
const type = 'new';

/**
 * Use the route structure created in web.php.
 */
QuickRequest().get({
    url: '/record/' + type,
    data: function () {
        return {
            owner: document.getElementById('owner').value,
            tag: document.getElementById('tag').value,
        };
    },
    success: function (res) {
        console.log("Successful Process, Data: ", res.data);
    },
    error: function (err) {
        console.error("Error: " + err.data.message);
    }
});
```

## POST Method

Commonly used to send data to the server to create a new resource. It should not be idempotent. Data is sent in the message body and is suitable for operations that can have side effects or create resources.

### Create Records

- Routes in `web.php`:

```php
Route::post('/record', [YourController::class, 'store']);
```

- Method in `YourController.php`:

```php
public function store(Request $request)
{
    DB::beginTransaction();

    try {

        $record = new Record();
        $record->name = $request->name;
        $record->owner = $request->owner;
        $record->tag = $request->tag;
        $record->save();
        
        DB::commit();

        return response()->json([
            "Success" => "Record Created Successfully",
        ], 201);

    } catch (\Throwable $th) {
        
        DB::rollback();

        return response()->json([
            "Exception" => $th->getMessage(),
        ], 500);
    }
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Depending on the case, you should use
 * "form" when the data comes from a form
 * "data" when specific data needs to be sent.
 * 
 * In this example, we will use "form".
 */
QuickRequest().post({ 
    url: '/record',
    form: 'idForm',
    success: function(res){
        console.log("Successful Process");
    },
    error: function(err){
        console.error("Error: " + err.data.message);
    }
});
```

::: tip Reminder
When using the `form` property, it expects the ID assigned to the form in HTML. In this case, there is no need to use the # sign since it only works with IDs and not with classes.
:::

### Upload Files

If you want to upload files through QuickRequest, you should use the POST method. It's important to define the form in your HTML with `enctype="multipart/form-data"`.

To create a file-upload form, structure it as follows:

```html
<form id="uploadFile" enctype="multipart/form-data">
    <!-- ... -->
    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
    <!-- ... -->
</form>
```

In this case, always use `form` as the data source for QuickRequest:

```javascript
QuickRequest().post({ 
    url: '/record',
    form: 'uploadFile',
    success: function(res){
        console.log("Successful Process");
    },
    error: function(err){
        console.error("Error: " + err.data.message);
    }
});
```

This way, all values from your form, including files, will reach the backend. Forget about creating FormData and other validations to upload a file.

## PUT Method

Used to update an existing resource or create it if it does not exist. It should be idempotent and requires the entire representation of the resource.

- Routes in `web.php`:

```php
Route::put('/record/{id}', [YourController::class, 'replace']);
```

- Method in `YourController.php`:

```php
public function replace(Request $request, $id)
{
    DB::beginTransaction();

    try {

        $record = Record::find($id);
        $record->update($request->all());

        DB::commit();

        return response()->json([
            "Success" => "Record Updated",
        ], 200);

    } catch (\Throwable $th) {
        
        DB::rollback();

        return response()->json([
            "Exception" => $th->getMessage(),
        ], 500);
    }
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Depending on the case, you should use
 * "form" when the data comes from a form
 * "data" when specific data needs to be sent.
 * 
 * In this example, we will use "data".
 */

const idRecord = 10;

QuickRequest().put({ 
    url: '/record/' + idRecord,
    data: function () {
        return {
            name: document.getElementById('name').value,
            owner: document.getElementById('owner').value,
            tag: document.getElementById('tag').value,
        };
    },
    success: function(res){
        console.log("Successful Process");
    },
    error: function(err){
        console.error("Error: " + err.data.message);
    }
});
```

## PATCH Method

Used to apply partial modifications to an existing resource. It should be idempotent and allows sending only the changes that need to be applied.

- Routes in `web.php`:

```php
Route::patch('/record/{id}', [YourController::class, 'update']);
```

- Method in `YourController.php`:

```php
public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {

        $record = Record::find($id);
        $record->update($request->only(['tag']));

        DB::commit();

        return response()->json([
            "Success" => "Record Updated",
        ], 200);

    } catch (\Throwable $th) {
        
        DB::rollback();

        return response()->json([
            "Exception" => $th->getMessage(),
        ], 500);
    }
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Depending on the case, you should use
 * "form" when the data comes from a form
 * "data" when specific data needs to be sent.
 * 
 * In this example, we will use "data".
 */

const idRecord = 10;

QuickRequest().patch({ 
    url: '/record/' + idRecord,
    data: function () {
        return {
            tag: document.getElementById('tag').value,
        };
    },
    success: function(res){
        console.log("Successful Process");
    },
    error: function(err){
        console.error("Error: " + err.data.message);
    }
});
```

## DELETE Method

Used to request the deletion of a resource. It should be idempotent and indicates that the resource identified by the URI should be deleted.

- Routes in `web.php`:

```php
Route::delete('/record/{id}', [YourController::class, 'destroy']);
```

- Method in `YourController.php`:

```php
public function destroy($id)
{
    DB::beginTransaction();

    try {

        $record = Record::find($id);
        $record->delete();

        DB::commit();

        return response()->json([
            "Success" => "Record Deleted",
        ], 200);

    } catch (\Throwable $th) {
        
        DB::rollback();

        return response()->json([
            "Exception" => $th->getMessage(),
        ], 500);
    }
}
```

- `QuickRequest` Request

Remember that you can add the `eventListener` capability to QuickRequest to trigger the request only when an action is executed:

```javascript
/**
 * Depending on the case, you should use
 * "form" when the data comes from a form
 * "data" when specific data needs to be sent.
 * 
 * In this example, we will use "data".
 */

const idRecord = 10;

QuickRequest().delete({ 
    url: '/record/' + idRecord,
    success: function(res){
        console.log("Successful Process");
    },
    error: function(err){
        console.error("Error: " + err.data.message);
    }
});
```