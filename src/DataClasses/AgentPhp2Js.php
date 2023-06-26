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

class AgentPhp2Js
{

    /**
     * Propierties Object
     */
    private $agent;

    /**
     * Constructor Class
     */
    public function __construct()
    {
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * Validata if is mobile the agent
     * @return bool
     */
    public function isMobileDevice(): bool
    {
        $mobileKeywords = [
            'Mobile',
            'Android',
            'iPhone',
            'iPad',
            'iPod',
            'Windows Phone',
            'BlackBerry',
            'webOS',
            'Opera Mini',
            'IEMobile',
        ];

        foreach ($mobileKeywords as $keyword) {
            if (stripos($this->agent, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return Name Current OS
     * @return string
     */
    public function getDataClienteSO(): string
    {
        $operatingSystems = array(
            '/\bWindows\b/i' => 'Windows',
            '/\bMacintosh\b|Mac(?!.+OS X)/i' => 'Mac',
            '/\bLinux\b/i' => 'Linux',
            '/\bAndroid\b/i' => 'Android',
            '/\biPhone\b|\biPad\b|\biPod\b/i' => 'iOS',
        );

        $so = 'Unknown';
        foreach ($operatingSystems as $pattern => $os) {
            if (preg_match($pattern, $this->agent)) {
                $so = $os;
                break;
            }
        }

        return $so;
    }

    /**
     * Return Data Browser
     * @return array
     */
    public function getDataBrowser(): array
    {
        $u_agent = $this->agent;
        $bname = 'No Identificado';
        $platform = 'No Identificado';
        $version = 'No Identificado';

        // Plataforma
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Macintosh';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }

        // Navegador
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // Número de Versión
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (preg_match_all($pattern, $u_agent, $matches)) {
            $i = count($matches['browser']);
            if ($i > 0) {
                $version = $matches['version'][$i - 1];
            }
        }

        // Comprobar si tenemos una versión válida
        if ($version == null || $version == '') {
            $version = 'Desconocida';
        }

        // Validar si es Edge
        if (str_contains($this->agent, 'Edg/')) {
            $bname = 'Microsoft Edge';
        }

        $response = [
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
        ];

        return $response;
    }

    /**
     * Return Remote IP
     * @return string
     */
    public function getIpAddress(): string
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    /**
     * Return Remote Port
     * @return string
     */
    public function getRemotePort(): string
    {
        return isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : null;
    }

    /**
     * Return Remote Agent
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }
}