---
title: Only
editLink: true
outline: deep
---

# Only 

## Only User-Defined Values

The `.only(...props)` method allows you to extract information from the object delivered by PHP, including only the values you need as parameters. This will be useful when you don't want to load the entire content of the constant.

```javascript
// Retrieve only the data passed as arguments in the Only method
// Remember to replace PHP2JS with the Alias you have used.
const post = PHP2JS.only('post');
```

## Only Functions

The `.onlyFunctions()` method allows you to extract information from the functions existing in the object delivered by PHP to JavaScript.

```javascript
// Retrieve only the methods or functions of the object delivered by PHP to JavaScript.
// Remember to replace PHP2JS with the Alias you have used.
const functions = PHP2JS.onlyFunctions();
```