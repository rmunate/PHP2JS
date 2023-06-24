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

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\DataClasses\UrlPhp2Js;
use Rmunate\Php2Js\DataClasses\UserPhp2Js;
use Rmunate\Php2Js\DataClasses\AgentPhp2Js;
use Rmunate\Php2Js\DataClasses\TokenPhp2Js;
use Rmunate\Php2Js\DataClasses\ServerPhp2Js;
use Rmunate\Php2Js\DataClasses\LaravelPhp2Js;

/**
 * Methods Get Data In Array Asociative
 */
class DataPhp2Js
{

    /**
     * Version Library
     */
    const VERSION = "3.5.1";

    /**
     * Return Data agent
     * @return Array
     */
    public static function getDataAgent() : array
    {
        $data = new AgentPhp2Js();
        return [
            'agent' => [
                "identifier" => $data->getAgent(),
                "remote_ip" => $data->getIpAddress(),
                "remote_port" => $data->getRemotePort(),
                "browser" => $data->getDataBrowser(),
                "isMobile" => $data->isMobileDevice(),
                "OS" => $data->getDataClienteSO(),
            ],
        ];
    }

    /**
     * Return Array with Data Url In Use
     * @return array
     */
    public static function getDataUrl(): array
    {
        $data = new UrlPhp2Js();
        return [
            'url' => [
                "baseUrl" => $data->getBaseUrl(),
                "fullUrl" => $data->getFullUrl(),
                "uri" => $data->getUri(),
                "parameters" => [
                    "route" => $data->getParametersRoute(),
                    "get" => $data->getParametersGet(),
                    "post" => $data->getParametersPost(),
                ],
                "scheme" => $data->getSchema()
            ]
        ];
    }

    /**
     * Return Token CSRF Laravel
     * @return array
     */
    public static function getDataCSRF() : array
    {
        $data = new TokenPhp2Js();
        return [
            "token" => $data->csrfToken(),
        ];
    }

    /**
     * Return Data Laravel
     * @return array
     */
    public static function getDataLaravel() : array
    {
        $data = new LaravelPhp2Js();
        return [
            'framework' => [
                "version" => $data->getLaravelVersion(),
                "environment" => [
                    "name" => $data->getEnvName(),
                    "debug" => $data->getEnvDebug() == true,
                ]
            ]
        ];
    }

    /**
     * Return Data PHP
     * @return array
     */
    public static function getDataPHP() : array
    {
        $data = new ServerPhp2Js();
        return [
            'php' => [
                "id" => $data->getPhpVersionId(),
                "version" => $data->getPhpVersion(),
                "release" => $data->getPhpReleaseVersion(),
            ]
        ];
    }

    /**
     * Return User Data
     * @return Mixed
     */
    public static function getDataUser()
    {
        $data = new UserPhp2Js();
        return [
            'user' => $data->getDataUser()
        ];
    }
    
}

?>
