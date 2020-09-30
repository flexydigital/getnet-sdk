<?php
namespace Getnet\API;

trait ToStringJsonTrait
{
    /**
     * @return string
     */
    public function __toString()
    {
        if (!($json = json_encode($this))) {
            return '';
        }

        return $json;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {

        $vars = get_object_vars($this);
        $vars_clear = array_filter($vars, function ($value) {
            return null !== $value;
        });

        return $vars_clear;
    }
}