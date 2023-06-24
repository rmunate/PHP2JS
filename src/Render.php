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
    private $attach;

    /**
     * Determinate Inject JS
     */
    private $injectJS = false;
    private $alias;
    private $strictUse;
    private $varsJS;
    private $script;

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
        $this->attach = false;
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
    public function toJS(string $mainName = 'PHP2JS') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;
        $this->alias = $mainName;
        $this->strictUse = false;
        $this->varsJS = new Collection(['vars' => $this->data]);
        return $this;
    }

    /**
     * @param string $mainName
     * 
     * @return static
     */
    public function toStrictJS(array $vars = [], string $mainName = 'PHP2JS') : static
    {
        /* Active Inject JS */
        $this->injectJS = true;
        $this->alias = $mainName;
        $this->strictUse = true;
        $this->varsJS = !empty($vars) ? new Collection(['vars' => $vars]) : new Collection(['vars' => $this->data]);
        return $this;
    }

    /**
     * @param mixed ...$parametros
     * @return static
     */
    public function attach(...$parametros){
        if ($this->injectJS) {
            $this->attach = $parametros;
            return $this;
        }
        throw new \Exception("PHP2JS\Render exception, you cannot bind additional data blocks without using the 'toJS()' or 'toStrictJS()' methods before.");
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

            if (!empty($this->attach)) {
                if (in_array('agent', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataAgent());
                if (in_array('url', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataUrl());
                if (in_array('csrf', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataCSRF());
                if (in_array('framework', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataLaravel());
                if (in_array('php', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataPHP());
                if (in_array('user', $this->attach)) $this->varsJS = $this->varsJS->merge(DataPhp2Js::getDataUser());
            }

            $uniqueID = strtoupper(bin2hex(random_bytes(16)));
            $jsonEncode = json_encode($this->varsJS);
            
            $script  =  '<script id="'.$uniqueID.'">
                            '.$this->license.'
                            const '.$this->alias.' = '.$jsonEncode.'
                            document.getElementById("'.$uniqueID.'").remove();
                        </script>';

            /* Inject JS */
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