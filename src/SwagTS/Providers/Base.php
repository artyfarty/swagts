<?php
/**
 * @author artyfarty
 */

namespace SwagTS\Providers;


abstract class Base {
    protected $params = [];
    public function __construct($params) {
        $this->params = $params;
    }

    public abstract function getClasses();
}