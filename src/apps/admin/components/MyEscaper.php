<?php 
namespace Multiple\Admin\Components;
use Phalcon\Escaper;

/**
 * Escaper class 
 */
class MyEscaper 
{
    /**
     * sanatize function
     * It returns the string in escaped format
     * @param [type] string
     * @return string
     */
    public function sanatize($t)
    {
       $escaper = new Escaper();
       return $escaper->escapeHtml($t);   
    }

    /**
     * escaped function
     * Returns the whole array in escaped format
     * @param [type] $array
     * @return array
     */
    public function escaped($array)
    {
        $escInput = array();
        foreach ($array as $key => $value) {
            $escInput[$key] = $this->sanatize($value);
        }
    return $escInput;         
    }

}