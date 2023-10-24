---
outline: deep
---

# Except 

## Everything Except User-Defined Values

The `.except(...props)` method allows you to extract information from the object delivered by PHP, excluding the values you don't want to consider as parameters. This will be useful when you don't want to load the entire content of the constant.

```javascript
// Retrieve only the data you require while excluding others.
// Remember to replace PHP2JS with the Alias you have used.
const withoutNews = PHP2JS.except('news');
```

## Except Functions

The `.exceptFunctions()` method allows you to extract information from the variables and pre-constructed code blocks except for methods and functions.

```javascript
// Retrieve only the values of the object delivered by PHP to JavaScript.
// Remember to replace PHP2JS with the Alias you have used.
const values = PHP2JS.exceptFunctions();
```