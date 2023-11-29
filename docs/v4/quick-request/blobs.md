---
title: Blob
editLink: true
outline: deep
---

# Blob

Blob stands for "Binary Large Object," and it is a data type used to store binary data such as images, audio files, or videos.

Blobs can be easily manipulated with QuickRequest, whether for upload or download.

## Upload File

If you want to upload files through QuickRequest, use the POST method. It's important to define the form in your HTML with `enctype="multipart/form-data"`.

- Routes in `web.php`:

```php
Route::post('/upload-image', [YourController::class, 'uploadImage']);
```

- HTML Form:
To create a file-upload form, structure it as follows:

```html
<form id="uploadFile" enctype="multipart/form-data">
    <!-- ... -->
    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
    <!-- ... -->
</form>
```

- QuickRequest Syntax:
In this case, always use `form` as the data source for QuickRequest:

```javascript
QuickRequest().post({ 
    url: '/upload-image',
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

## Download File

If you want to download a file, you can easily do it using the GET method.

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

- QuickRequest Request:

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