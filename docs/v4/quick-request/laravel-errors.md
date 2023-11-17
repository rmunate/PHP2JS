---
title: Laravel Errors
outline: deep
---

# Errores 

Ahora veremos como recibiremos los errores que sucedan en el tratameitno de nuestra solicitud por parte del backend de laravel. Ya sea por FormRequest, Validator, Exceptions o cualquier otro origen.

Es escencial recibir una respuesta estandar de los errores ocurridos, ya que no es común el crear personalizaciones por cada una de las peticiones al backend de los posibles errores generados.

Para esto QuickRequest siempre retorna una misma estructura de errores, independientemente sean errores lanzados de forma proghramada en nuestro codigo, por bloques catch o por expeciones del Marco.

A continuacion vemos la estructura con la que llega el valor a la funcion `error`

```javascript
QuickRequest.get({ 
    //...
    error: function(err){

        //Veamos la estrcutura:
        console.log(err);

        /**
         * Salida de Consola
         */




    },
    //...
});
```