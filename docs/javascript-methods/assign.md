---
outline: deep
---

# Assign

## Assign Same Object

The `.assign()` method assigns the same values of the object delivered by PHP to a new variable or constant. Now you can remove the original object without losing the values you leave in the new one. This will be useful when you want the values not to be accessible from different references to the original object and instead use an object in JavaScript runtime.

```javascript
// Assign a copy of the object to a new variable at runtime.
// Remember to replace PHP2JS with the Alias you have used.
const __PHP = PHP2JS.assign();

// You can now clear the original object.
PHP2JS.clear();

// The values will now be in "__PHP"
```

## Assign and Clear

The `.assignAndClear()` method assigns the same values of the object delivered by PHP to a new variable or constant and additionally clears the original object. This will be useful when you want the values not to be accessible from different references to the original object and instead use an object in JavaScript runtime.

```javascript
// Clear the Object (All references to the original object will lose their values)
// Remember to replace PHP2JS with the Alias you have used.
const __PHP = PHP2JS.assignAndClear();

// The values will now be in "__PHP"
```

## Assign and Clear Without Functions

The `.assignAndClearWithoutFunctions()` method assigns the same values of the object delivered by PHP to a new variable or constant and additionally clears the original object, but it does not remove the functions or methods. This will be useful when you want the values not to be accessible from different references to the original object and instead use an object in JavaScript runtime.

```javascript
// Clear the Object (Without removing functions or methods)
// Remember to replace PHP2JS with the Alias you have used.
const __PHP = PHP2JS.assignAndClearWithoutFunctions();

// The values will now be in "__PHP," and the methods of the object will still exist in "PHP2JS."
```