<?php

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\Bases\BaseRender;
use Rmunate\Php2Js\Elements\Generator;

class Render extends BaseRender
{
    /**
     * Propierties Object
     * Set From Contrcutor.
     */
    private $view;
    private $data;
    private $alias;
    private $dataJS = [];

    /**
     * Constructor.
     *
     * @param string $view
     */
    public function __construct(string $view)
    {
        $this->view = $view;
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
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return static
     */
    public function toJS(string $alias = 'PHP2JS'): static
    {
        $this->dataJS = $this->data;
        $this->alias = $alias;

        return $this;
    }

    /**
     * @param array  $data
     * @param string $alias
     *
     * @return static
     */
    public function toStrictJS(array $data = [], string $alias = 'PHP2JS'): static
    {
        $this->dataJS = $data;
        $this->alias = $alias;

        return $this;
    }

    /**
     * Return the View.
     *
     * @return mixed
     */
    public function compose()
    {
        $view = view($this->view)->with($this->data);
        $html = $view->render();

        $metas = Generator::alias($this->alias)->data($this->dataJS);
        $scripts = Generator::alias($this->alias)->script();

        $posicionCierreHead = strpos($html, '</head>');
        $posicionCierreBody = strpos($html, '</body>');

        if ($posicionCierreHead !== false) {
            $ssr[0] = substr($html, 0, $posicionCierreHead);
            $ssr[1] = $metas;
            $ssr[2] = $scripts;
            $ssr[3] = substr($html, $posicionCierreHead);

            $html = implode(PHP_EOL, $ssr);
        } elseif ($posicionCierreBody !== false) {
            $ssr[0] = substr($html, 0, $posicionCierreBody);
            $ssr[1] = $metas;
            $ssr[2] = $scripts;
            $ssr[3] = substr($html, $posicionCierreBody);

            $html = implode(PHP_EOL, $ssr);
        } else {
            $html .= $metas.$scripts;
        }

        return response($html);
    }
}
