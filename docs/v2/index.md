---
title: ^2.6.4
---

![logo](https://user-images.githubusercontent.com/91748598/236917119-68ae265f-56b4-433e-a0f4-4379c2e93e99.png)

**Read variables returned from the controller and defined in the Blade view into external JavaScript files, perfect library for Blade monoliths.**

All the imports that you use in the following way, after invoking this library will have access to the PHP variables, easy and very useful.

```javascript
<script src="{{ asset('..............js') }}"></script>
```

Read PHP variables in external JavaScript files without needing to make unnecessary AJAX, FETCH or AXIOS requests, use the same variables returned by the controller or created in the view before invoking the library, like some additional values that will simplify your work enormously.

- Read all variables returned by the controller in external JavaScript files to keep a clean code structure.
- Read all variables declared in the Blade view, from external JavaScript files.
- Obtain the information of the URL in use, the protocol, the URI, the parameters, etc.
- Obtain the information of the PHP version in use. Version, ID, etc.
- Obtain the data of the Agent, Remote IP address from where the system is entered, port in use, Operating System, etc.
- Get a valid CSRF token anywhere in your JavaScript.
- Obtain the relevant data of the User in session, protecting the ID with the Laravel Helper Crypt::encrypt($id).