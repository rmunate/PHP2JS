<?php

/*
 * Copyright (c) [2023] [RAUL MAURICIO UÑATE CASTRO]
 *
 * Esta biblioteca es un software de código abierto disponible bajo la licencia MIT.
 * Se concede permiso, de forma gratuita, a cualquier persona que obtenga una copia de esta biblioteca y los archivos de
 * documentación asociados (el "Software"), para utilizar la biblioteca sin restricciones, incluyendo, entre otras, las
 * siguientes acciones:
 *
 * - Utilizar la biblioteca con fines comerciales o no comerciales.
 * - Modificar la biblioteca y adaptarla a sus propias necesidades.
 * - Distribuir copias de la biblioteca.
 * - Sublicenciar la biblioteca.
 *
 * Al utilizar o distribuir esta biblioteca, se requiere que se incluya la siguiente atribución en todas las copias o
 * partes sustanciales de la misma:
 *
 * "[RAUL MAURICIO UÑATE CASTRO], titular de los derechos de autor de esta biblioteca, debe ser
 * reconocido y mencionado en todas las copias o derivados de la biblioteca."
 *
 * Además, si se realizan modificaciones en la biblioteca, se solicita que se incluya una nota adicional en la
 * documentación o en cualquier otro medio de notificación de los cambios realizados, que indique:
 *
 * "Esta biblioteca se ha modificado a partir de la biblioteca original desarrollada por [RAUL MAURICIO UÑATE CASTRO]."
 *
 * LA BIBLIOTECA SE PROPORCIONA "TAL CUAL", SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O IMPLÍCITA, INCLUYENDO PERO NO
 * LIMITADO A GARANTÍAS DE COMERCIALIZACIÓN, ADECUACIÓN PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE NINGUNA RECLAMACIÓN, DAÑO O OTRA
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O CUALQUIER OTRO MOTIVO, QUE SURJA DE, O EN RELACIÓN CON
 * LA BIBLIOTECA O EL USO U OTROS TRATOS EN LA BIBLIOTECA.
 */

namespace Rmunate\Php2Js\DataClasses;

use Illuminate\Support\Facades\Route;

class UrlPhp2Js
{
    /**
     * Propierties Object
     */
    private $facadeRouteCurrent;
    private $serverHTTPx;
    private $serverHost;
    private $serverUri;

    /**
     * Contructor Class
     * Routes
     */
    public function __construct() {
        $this->facadeRouteCurrent = Route::current();
        $this->serverHTTPx = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $this->serverHost = $_SERVER['HTTP_HOST'];
        $this->serverUri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @param string $path
     * @param array $parameters
     * @param null $secure
     * 
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->serverHTTPx . $this->serverHost  ."/";
    }

    /**
     * return full uri current
     * @return string
     */
    public function getFullUrl() : string
    {
        return $this->serverHTTPx . $this->serverHost . $this->serverUri;
    }

    /**
     * Return Current Uri in Use
     * Use Facade Laravel
     * @return string
     */
    public function getUri() : string
    {
        return $this->facadeRouteCurrent->uri;
    }

    /**
     * Return Parameter Route Laravel
     * Use Facade Laravel
     * @return string
     */
    public function getParametersRoute() :array
    {
        return $this->facadeRouteCurrent->parameters;
    }

    /**
     * Return Parameter POST
     * @return string
     */
    public function getParametersPost() : array
    {
        return !empty($_POST) ? $_POST : [];
    }

    /**
     * Return Parameter GET
     * @return string
     */
    public function getParametersGet() : array
    {
        return !empty($_GET) ? $_GET : [];
    }

    /**
     * Return schema in use
     * @return string
     */
    public function getSchema() : string 
    {
        return strtoupper(str_replace('://', '', $this->serverHTTPx));
    }

}

?>