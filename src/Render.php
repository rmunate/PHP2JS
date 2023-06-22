<?php

/*
 * Copyright (c) [2023] [RAUL MAURICIO UÑATE CASTRO]
 * https://github.com/rmunate/PHP2JS
 *
 * Esta biblioteca es un software de código abierto disponible bajo la licencia MIT.
 * Se concede permiso, de forma gratuita, a cualquier persona que obtenga una copia de esta biblioteca y los archivos de
 * documentación asociados (el "Software"), para utilizar la biblioteca sin restricciones, incluyendo, entre otras, las
 * siguientes acciones:
 *
 * - Utilizar la biblioteca con fines comerciales o no comerciales.
 * - Modificar la biblioteca y adaptarla a sus propias necesidadeess.
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

use Rmunate\Php2Js\License;
use Rmunate\Php2Js\DataPhp2Js;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Rmunate\Php2Js\BasePhp2Js as BaseRender;

class Render extends BaseRender
{
    /**
     * Propierties Object
     * Set From Contrcutor
     */
    private $view;
    private $data;
    private $license;

    /**
     * Determinate Inject JS
     */
    private $injectJS = false;
    private $script;

    /**
     * Constructor
     *
     * @param string $view
     * @param array $data
     */
    public function __construct(string $view, array $data = [])
    {
        /* Values Requerid */
        $this->view = trim($view);
        $this->data = new Collection($data);
        $this->license = License::comment();

        /* Delete Use The File In Public Path*/
        @File::deleteDirectory(public_path("server-data"));
    }

    /**
     * Create a new Render instance.
     *
     * @param string $view
     * @param array $data
     * @return static
     */
    public static function view(string $view, array $data = []): static
    {
        return new static($view, $data);
    }

    /**
     * Add data to the Render instance.
     *
     * @param array $data
     * @return static
     */
    public function with(array $data): static
    {
        $this->data = $this->data->merge($data);
        return $this;
    }

    /**
     * @param string $mainName
     * 
     * @return static
     */
    public function toJS(string $mainName = 'PHP') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;

        /* Values To JSON_ENCODE */
        $dataEncode = json_encode($this->data->toArray());
        $dataUrl = json_encode(DataPhp2Js::getDataUrl());
        $dataCSRF = json_encode(DataPhp2Js::getDataCSRF());
        $license = $this->license;

        /* Generate JS Content */
        $this->script = <<<JS

        {$license}

        const {$mainName} = {
            vars : {$dataEncode}, url : {$dataUrl}, csrf : {$dataCSRF},
        }
        JS;

        return $this;
    }

    /**
     * @param string $mainName
     * 
     * @return static
     */
    public function toAllJS(string $mainName = 'PHP') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;

        /* Values To JSON_ENCODE */
        $dataEncode = json_encode($this->data->toArray());
        $dataUrl = json_encode(DataPhp2Js::getDataUrl());
        $dataCSRF = json_encode(DataPhp2Js::getDataCSRF());
        $dataPHP = json_encode(DataPhp2Js::getDataPHP());
        $dataLaravel = json_encode(DataPhp2Js::getDataLaravel(), JSON_PRETTY_PRINT);
        $dataUser = json_encode(DataPhp2Js::getDataUser());
        $dataAgent = json_encode(DataPhp2Js::getDataAgent());
        $license = $this->license;

        /* Generate JS Content */
        $this->script = <<<JS

        {$license}

        const {$mainName} = {
            vars : {$dataEncode}, url : {$dataUrl}, csrf : {$dataCSRF}, php : {$dataPHP}, laravel : {$dataLaravel}, user : {$dataUser}, agent : {$dataAgent}
        }
        JS;

        return $this;
    }

    /**
     * @param string $mainName
     * 
     * @return static
     */
    public function toStrictJS(string $mainName = 'PHP') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;

        /* Values To JSON_ENCODE */
        $dataEncode = json_encode($this->data->toArray());
        $license = $this->license;

        /* Generate JS Content */
        $this->script = <<<JS

        {$license}

        const {$mainName} = {
            vars : {$dataEncode}
        }

        JS;

        return $this;
    }

    /**
     * @param string $mainName
     * 
     * @return static
     */
    public function toJSWith(array $groupsData = [], string $mainName = 'PHP') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;

        /* Grupos De Datos */
        $groupsData = array_map('strtolower', $groupsData);

        /* Values To JSON_ENCODE */
        $dataEncode = json_encode($this->data->toArray());
        if (empty($groupsData)) {
            $dataUrl = json_encode(DataPhp2Js::getDataUrl());
            $dataCSRF = json_encode(DataPhp2Js::getDataCSRF());
            $dataPHP = json_encode(DataPhp2Js::getDataPHP());
            $dataLaravel = json_encode(DataPhp2Js::getDataLaravel(), JSON_PRETTY_PRINT);
            $dataUser = json_encode(DataPhp2Js::getDataUser());
            $dataAgent = json_encode(DataPhp2Js::getDataAgent());
        } else {
            $dataUrl = (in_array('url', $groupsData)) ? json_encode(DataPhp2Js::getDataUrl()) : json_encode(null);
            $dataCSRF = (in_array('csrf', $groupsData)) ? json_encode(DataPhp2Js::getDataCSRF()) : json_encode(null);
            $dataPHP = (in_array('php', $groupsData)) ? json_encode(DataPhp2Js::getDataPHP()) : json_encode(null);
            $dataLaravel = (in_array('laravel', $groupsData)) ? json_encode(DataPhp2Js::getDataLaravel(), JSON_PRETTY_PRINT) : json_encode(null);
            $dataUser = (in_array('user', $groupsData)) ? json_encode(DataPhp2Js::getDataUser()) : json_encode(null);
            $dataAgent = (in_array('user', $groupsData)) ? json_encode(DataPhp2Js::getDataAgent()) : json_encode(null);
        }
        $license = $this->license;
        
        /* Generate JS Content */
        $this->script = <<<JS
        
        {$license}

        const {$mainName} = {
            vars : {$dataEncode}, url : {$dataUrl}, csrf : {$dataCSRF}, php : {$dataPHP}, laravel : {$dataLaravel}, user : {$dataUser}, agent : {$dataAgent}
        }
        for (let clave in {$mainName}) { if ({$mainName}[clave] === null) delete {$mainName}[clave]; }

        JS;

        return $this;
    }

    /**
     * Return the View
     * @return View
     */
    public function compose()
    {
        if (!$this->injectJS) {

            return view($this->view)->with($this->data->toArray());

        } else {

            $view = view($this->view)->with($this->data->toArray());
            $html = $view->render();

            /* X2JS_MAIN */
            $_X2JS_MAIN = $this->script;

            /*  _X2JS_DOM */
            $_X2JS_DOM = 'setTimeout(() => {
                document.getElementById("_X2JS_MAIN").remove();
                document.getElementById("_X2JS_DOM").remove();
            }, 500);';

            $script = '<script id="_X2JS_MAIN">'.$_X2JS_MAIN.'</script><script id="_X2JS_DOM">'.$_X2JS_DOM.'</script>';
            $posicionCierreHead = strpos($html, '</head>');
            $posicionCierreBody = strpos($html, '</body>');

            if ($posicionCierreHead !== false) {
                $htmlOut = substr($html, 0, $posicionCierreHead) . $script . PHP_EOL . substr($html, $posicionCierreHead);
            } elseif ($posicionCierreBody !== false) {
                $htmlOut = substr($html, 0, $posicionCierreBody) . $script . PHP_EOL . substr($html, $posicionCierreBody);
            } else {
                $htmlOut = $script . $html;
            }

            return response($htmlOut);
        }
    }
}


?>