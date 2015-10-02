<?php

namespace App;

use App\Exception\ViewNotFoundException;

/**
 *
 */
class View
{
    private $vars = array();
    private $template = null;
    private $separators = array("\\", "/");

    /**
     * [set description]
     * @param [type] $attr  [description]
     * @param [type] $value [description]
     */
    public function set($attr, $value)
    {
        $this->vars[$attr] = $value;
    }

    /**
     * [render description]
     * @param  [type] $who [description]
     * @return [type]      [description]
     */
    public function render($who = null)
    {
        if ($who == null) {
            if (empty($this->template)) {
                throw new ViewNotFoundException();
            } else {
                self::render($this->template);
            }
        } else {
            //Create variables
            foreach ($this->vars as $var => $value)
                ${$var} = $value;

            include "views" . DIRECTORY_SEPARATOR . str_replace(".", DIRECTORY_SEPARATOR, $who) . ".php";

            //Unset variables
            foreach ($this->vars as $var => $value)
                unset(${$var});
        }
    }

    /**
     * [setTemplate description]
     * @param [type] $template [description]
     */
    public function setTemplate($template)
    {
        $this->template = str_replace($this->separators, ".", strtolower($template));
        return $this;
    }

    public function getTemplate()
    {
        return $this->template;
    }

}
