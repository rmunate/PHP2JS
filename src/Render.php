<?php

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\Bases\BasePhp2Js;
use Rmunate\Php2Js\Data\DataPhp2Js;
use Rmunate\Php2Js\License\License;

class Render extends BasePhp2Js
{
    /**
     * Propierties Object
     * Set From Contrcutor.
     */
    private $view;
    private $data;
    private $license;
    private $attach;

    /**
     * Determinate Inject JS.
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
     * @param array  $data
     *
     * @return static
     */
    public static function view(string $view, array $data = []): static
    {
        return new static($view, $data);
    }

    /**
     * Constructor.
     *
     * @param string $view
     * @param array  $data
     */
    public function __construct(string $view, array $data = [])
    {
        /* Values Requerid */
        $this->view = trim($view);
        $this->data = $data;
        $this->license = License::comment();
        $this->attach = false;
    }

    /**
     * Add data to the Render instance.
     *
     * @param array $data
     *
     * @return static
     */
    public function with(array $data): static
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    /**
     * @param string $mainName
     *
     * @return static
     */
    public function toJS(string $mainName = 'PHP2JS'): static
    {
        /* Active Inject JS */
        $this->injectJS = true;
        $this->alias = $mainName;
        $this->strictUse = false;
        $this->varsJS = ['vars' => $this->data];

        return $this;
    }

    /**
     * @param string $mainName
     *
     * @return static
     */
    public function toStrictJS(array $vars = [], string $mainName = 'PHP2JS'): static
    {
        /* Active Inject JS */
        $this->injectJS = true;
        $this->alias = $mainName;
        $this->strictUse = true;
        $this->varsJS = !empty($vars) ? ['vars' => $vars] : ['vars' => $this->data];

        return $this;
    }

    /**
     * @param mixed ...$parametros
     *
     * @return static
     */
    public function attach(...$parametros)
    {
        if ($this->injectJS) {
            $this->attach = $parametros;

            return $this;
        }

        throw new \Exception("PHP2JS\Render exception, you cannot bind additional data blocks without using the 'toJS()' or 'toStrictJS()' methods before.");
    }

    /**
     * Return the View.
     *
     * @return View
     */
    public function compose()
    {
        if (!$this->injectJS) {
            return view($this->view)->with($this->data);
        } else {
            $view = view($this->view)->with($this->data);
            $html = $view->render();

            if (!empty($this->attach)) {
                if (in_array('agent', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataAgent());
                }

                if (in_array('url', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataUrl());
                }

                if (in_array('csrf', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataCSRF());
                }

                if (in_array('framework', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataLaravel());
                }

                if (in_array('php', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataPHP());
                }

                if (in_array('user', $this->attach)) {
                    $this->varsJS = array_merge($this->varsJS, DataPhp2Js::getDataUser());
                }
            }

            $jsonEncode = json_encode($this->varsJS, JSON_UNESCAPED_UNICODE);
            $idElement = strtoupper(bin2hex(random_bytes(16)));
            $license = $this->license;
            $alias = $this->alias;

            $script = <<<SCRIPT
            <script id="$idElement">
                $license
                const $alias = $jsonEncode;
                $alias.clear = function() {
                    Object.keys($alias).forEach(function(property) {
                        delete $alias[property];
                    });
                };
                document.getElementById("$idElement").remove();
            </script>
            SCRIPT;

            /* Inject JS */
            $posicionCierreHead = strpos($html, '</head>');
            $posicionCierreBody = strpos($html, '</body>');

            if ($posicionCierreHead !== false) {
                $htmlOut = substr($html, 0, $posicionCierreHead).$script.PHP_EOL.substr($html, $posicionCierreHead);
            } elseif ($posicionCierreBody !== false) {
                $htmlOut = substr($html, 0, $posicionCierreBody).$script.PHP_EOL.substr($html, $posicionCierreBody);
            } else {
                $htmlOut = $script.$html;
            }

            return response($htmlOut);
        }
    }
}
