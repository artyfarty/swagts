<?php
/**
 * @author artyfarty
 */

namespace SwagTS\Providers;


class JSONSchema extends Base {
    public function getClasses() {
        $schema = json_decode($this->params['json_schema'], true);
        return $schema['models'];
    }
}