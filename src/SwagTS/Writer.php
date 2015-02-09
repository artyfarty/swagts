<?php
/**
 * @author artyfarty
 */

namespace SwagTS;

use Swagger\Annotations as SWG;

class Writer {
    /**
     * @var Providers\Base $provider
     */
    protected $provider;
    protected $config = [
        "indent" => "  "
    ];

    /**
     * @param Providers\Base $provider
     * @param array $config
     */
    public function __construct($provider, $config = []) {
        $this->provider = $provider;
    }

    protected function indent($code) {
        $indent = $this->config['indent'];
        $strings = explode("\n", $code);
        foreach ($strings as &$s) {
            if (trim($s) === "") {
                continue;
            }

            $s = $indent . $s;
        }

        return implode("\n", $strings);
    }

    protected function rewriteType($type) {
        $rewrite = ['integer' => 'number', 'float' => 'number'];

        if (isset($rewrite[$type])) {
            $type = $rewrite[$type];
        }

        $type = str_replace("\\", ".", $type);

        return $type;
    }

    public function convertProperty($propName, $propInfo) {
        $propInfo = array_merge(
            [
                'description' => null,
                'items' => null,
            ], $propInfo);

        $getType = function($infoAarr) {
            if (isset($infoAarr['type'])) {
                return $infoAarr['type'];
            }
            if (isset($infoAarr['$ref'])) {
                return $infoAarr['$ref'];
            }

            return null;
        };

        $type = $this->rewriteType($getType($propInfo));
        $result = "";


        $has_ml_comment = (strpos($propInfo['description'], "\n") !== false);

        if ($has_ml_comment) {
            $result .= "/*\n";
            foreach (explode("\n", $propInfo['description']) as $s) {
                $s = trim($s);
                $result .= " * $s\n";
            }
            $result .= " */\n";
        }

        $result .= "{$propName}: ";

        if ($type === 'array') {
            if ($propInfo['items']) {
                $subtype = $getType($propInfo['items']);
                $subtype = $this->rewriteType($subtype);

                $result .= "{$subtype}[]";
            } else {
                $result .= "Array";
            }
        } else {
            $result .= $type;
        }

        $result .= ";";

        if (!$has_ml_comment && $propInfo['description']) {
            $result .= " // {$propInfo['description']}";
        }

        return $result;
    }


    public function convertClass($classInfo) {

        $output = "export interface {$classInfo['id']} {\n";

        foreach($classInfo['properties'] as $propName => $propInfo) {
            $output .= $this->indent($this->convertProperty($propName, $propInfo)) . "\n\n";
        }

        $output .= "}";

        return $output;
    }

    public function makeModule($moduleName) {
        $output = "declare module $moduleName {\n";

        $classes = $this->provider->getClasses();

        foreach ($classes as $className => $classInfo) {
            $output .= $this->indent($this->convertClass($classInfo)) . "\n\n";
        }

        $output .= "}";

        return $output;
    }
}