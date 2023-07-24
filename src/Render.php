<?php

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\Bases\BasePhp2Js;
use Rmunate\Php2Js\Data\DataPhp2Js;
use Rmunate\Php2Js\Exceptions\PHP2JSExceptions;
use Rmunate\Php2Js\JS\JS;
use Rmunate\Php2Js\Traits\JSUtilities;

class Render extends BasePhp2Js
{
    use JSUtilities;

    /**
     * Propierties Object
     * Set From Contrcutor.
     */
    private $view;
    private $data;
    private $license;
    private $attach;

    /**
     * Propierties Object
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
    public static function view(string $view, array $data = [])
    {
        return new self($view, $data);
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
        $this->license = $this->licence();
        $this->attach = [];
        $this->data = $data;
        $this->view = $this->clearView($view);
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
        $this->varsJS = ['vars' => $vars ?? $this->data];

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

        throw PHP2JSExceptions::create("PHP2JS\Render exception, you cannot bind additional data blocks without using the 'toJS()' or 'toStrictJS()' methods before.");
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
                $dataMethods = [
                    'agent'     => 'getDataAgent',
                    'url'       => 'getDataUrl',
                    'csrf'      => 'getDataCSRF',
                    'framework' => 'getDataLaravel',
                    'php'       => 'getDataPHP',
                    'user'      => 'getDataUser',
                ];

                foreach ($this->attach as $method) {
                    if (isset($dataMethods[$method])) {
                        $data = DataPhp2Js::{$dataMethods[$method]}();
                        $this->varsJS = array_merge($this->varsJS, $data);
                    }
                }
            }

            $jsonEncode = json_encode($this->varsJS, JSON_UNESCAPED_UNICODE);
            $idElement = $this->uniqueID();

            $script = JS::generateScriptTag($idElement, $this->license, $this->alias, $jsonEncode);

            return response($this->injectJS($html, $script));
        }
    }
}
