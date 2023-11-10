/**
 * Logica para cambiar el nombre del NavBar dependiendo
 * Dentro de cual version de la documentacion nos encontramos.
 */
let prevUrl = undefined;

setInterval(() => {

    //Obtener URL Actual
    let currentUrl = window.location.pathname;

    if (currentUrl != prevUrl) {

        //Obtener la Base URL
        let baseUrl = currentUrl.split('/v')[0]
        
        //Valores por defecto
        let nameVersion = '';
        let linkVersion = '';
    
        //Determinar que version incluye
        if(currentUrl.includes('/v2/')){
            nameVersion = '^2.6';
            linkVersion = '/v2/';
        } else if(currentUrl.includes('/v3/')){
            nameVersion = '^3.8';
            linkVersion = '/v3/';
        } else {
            nameVersion = '^4.0';
            linkVersion = '/v4/';
        }
    
        //Obtener Elementos a Modificar
        const navLink = document.getElementsByClassName('VPLink link VPNavBarMenuLink');
        const link = navLink[0];
        const text = navLink[0].children[0];
    
        //Cambiar Nombre:
        text.textContent = 'Docs ' + nameVersion;
        text.style = "font-weight: 500; color: #787bb3"
    
        //Cambiar Link
        link.href = baseUrl + linkVersion;

        //Guardar URL en el historial
        prevUrl = currentUrl;
    }
    
}, 10);