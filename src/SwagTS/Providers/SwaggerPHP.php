<?php
/**
 * @author artyfarty
 */

namespace SwagTS\Providers;


use Swagger\Swagger;

class SwaggerPHP extends Base {
    public function getClasses() {
        $swagger = new Swagger($this->params['directory']);
        return $swagger->getResource($this->params['resource'], ['output' => 'array'])['models'];
    }
}