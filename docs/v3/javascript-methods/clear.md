---
outline: deep
---

# Clear 

## Clear Object

The `.clear()` method will empty the object passed from PHP to JavaScript. This will be useful when you want the values not to be accessible from different object references.

```javascript
// Clear the Object (All object references will lose their values)
// Remember to replace PHP2JS with the Alias you have used.
PHP2JS.clear();
```

## Clear Without Functions

The `.clearWithoutFunctions()` method will clear the variables in the object passed from PHP to JavaScript but will not remove the methods listed in this section. This will be useful when you want the values not to be accessible from different object references.

```javascript
// Clear the Object (Functions will still exist)
// Remember to replace PHP2JS with the Alias you have used.
PHP2JS.clearWithoutFunctions();
```