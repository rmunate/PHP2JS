---
outline: deep
---

# Get 

## Get All Properties

The `.getAllProperties()` method creates an array with all the properties of the object.

```javascript
// Create an array with all the properties of the object.
// Remember to replace PHP2JS with the Alias you have used.
const existPost = PHP2JS.getAllProperties(); 
```

## Get a Specific Property

The `.get('prop')` method allows you to get a specific property from the object. It returns only the requested property.

```javascript
// In this example, we will retrieve only the value of "date"
// Remember to replace PHP2JS with the Alias you have used.
PHP2JS.get("date"); 
```