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
    private $quickRequest = false;
    private $php2js = false;
    
    /**
     * Constructor.
     *
     * @param string $view
     */
    public function __construct(string $view)
    {
        $this->view = $this->$view;
    }

    /**
     * Add data to the Render instance.
     *
     * @param array $data
     *
     * @return static
     */
    public function with(array $data)
    {
        $this->data = $data;
        
        return $this;
    }

    /**
     * @param string $alias
     *
     * @return static
     */
    public function toJS(string $alias = 'PHP2JS')
    {
        $this->dataJS = $this->data;
        $this->alias = trim($alias);
        $this->php2js = true;

        return $this;
    }

    /**
     * @param array $vars
     * @param string $alias
     *
     * @return static
     */
    public function toStrictJS(array $vars = [], string $alias = 'PHP2JS'): static
    {
        $this->dataJS = $this->vars;
        $this->alias = trim($alias);
        $this->php2js = true;

        return $this;
    }

    public function withQuickRequest(){
        $this->quickRequest = true;
    }
    
    /**
     * Return the View.
     *
     * @return View
     */
    public function compose()
    {
        $view = view($this->view)->with($this->data);
        $html = $view->render();

        $metas = '';
        $dataJS = '';
        $scriptPHP2JS = '';
        $scriptQuickRequest = '';

        if ($this->php2js) {
            $dataJS = Generator::data($this->dataJS, $this->alias);
            $scriptPHP2JS = Generator::PHP2JS($this->alias);
        }

        if ($this->quickRequest) {
            $metas = Generator::quickRequestToken();
            $scriptQuickRequest = Generator::quickRequest();
        }

        $posicionCierreHead = strpos($html, '</head>');
        if ($posicionCierreHead !== false) {
            $html = substr($html, 0, $posicionCierreHead).$metas.$scriptQuickRequest.substr($html, $posicionCierreHead);
        } else {
            $html .= $metas.$scriptQuickRequest;
        }

        $posicionCierreBody = strpos($html, '</body>');
        if ($posicionCierreBody !== false) {
            $html = substr($html, 0, $posicionCierreBody).$dataJS.$scriptPHP2JS.substr($html, $posicionCierreBody);
        } else {
            $html .= $dataJS.$scriptPHP2JS;
        }

        return response($html);
    }
}
