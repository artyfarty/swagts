<?php
/**
 * @author artyfarty
 */

namespace SwagTS\Providers;


use Swagger\Swagger;

class SwaggerPHP extends Base {
    protected $params = [];
    public function __construct($params) {
        $this->params = $params;
    }

    public function getClasses() {
        $swagger = new Swagger($this->params['directory']);
        return $swagger->getResource($this->params['resource'], ['output' => 'array'])['models'];
    }
}