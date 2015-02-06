<?php
/**
 * @author artyfarty
 */

namespace SwagTS;


use Doctrine\Common\Annotations\DocParser;
use ReflectionClass;
use ReflectionMethod;
use Swagger\Annotations as SWG;

class Writer {
    protected $reader;
    protected $config = [
        "indent" => "  "
    ];

    public function __construct($config = []) {
        $this->reader = new AnnotationReader;
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

    public function convertProperty(SWG\Property $prop) {
        $type = $this->rewriteType($prop->type);
        $name = $prop->name;
        $result = "";


        $has_ml_comment = (strpos($prop->description, "\n") !== false);

        if ($has_ml_comment) {
            $result .= "/*\n";
            foreach (explode("\n", $prop->description) as $s) {
                $s = trim($s);
                $result .= " * $s\n";
            }
            $result .= " */\n";
        }

        $result .= "{$name}: ";

        if ($type === 'array') {
            if ($prop->items) {
                $subtype = $this->rewriteType($prop->items->type);

                $result .= "{$subtype}[]";
            } else {
                $result .= "Array";
            }
        } else {
            $result .= $type;
        }

        $result .= ";";

        if (!$has_ml_comment && $prop->description) {
            $result .= " // $prop->description";
        }

        return $result;
    }


    public function convertClass($className) {
        $classReflect       = new ReflectionClass($className);

        /** @var SWG\Model $model */
        $model = $this->reader->getClassAnnotation($classReflect, 'Swagger\Annotations\Model');

        if (!$model) {
            throw new \Exception("$className has no SWG\\Model");
        }

        $modelName = $model->id;

        $output = "export interface $modelName {\n";

        foreach($classReflect->getProperties(\ReflectionProperty::IS_PUBLIC) as $propReflect) {
            /** @var SWG\Property $property */
            $property = $this->reader->getPropertyAnnotation($propReflect, 'Swagger\Annotations\Property');
            if (!$property) {
                continue;
            }

            $output .= $this->indent($this->convertProperty($property)) . "\n\n";
        }

        $output .= "}";

        return $output;
    }

    /**
     * @param \DirectoryIterator $d Directory to crawl
     * @param string             $ns            Namespace that will become a module
     * @param string             $nsPrefix      Namespace that contains the desired namespace
     * @return string
     * @throws \Exception
     */
    public function crawlDirectory(\DirectoryIterator $d, $ns, $nsPrefix = "\\") {
        $output = "declare module $ns {\n";

        foreach($d as $fileInfo) {
            if (strpos($fileInfo->getFilename(), '.') === 0) {
                continue;
            }

            if ($fileInfo->getExtension() === 'php') {
                $clsName = $fileInfo->getBasename('.php');
                require_once $fileInfo->getPathname();
                $output .= $this->indent($this->convertClass("{$nsPrefix}{$ns}\\$clsName")) . "\n\n";
            } elseif ($fileInfo->isDir()) {
                $nsName = $fileInfo->getBasename();
                $output .=  $this->indent($this->crawlDirectory(new \DirectoryIterator($fileInfo->getPathname()), $nsName, "{$nsPrefix}$ns\\" )) . "\n\n";
            }
        }

        $output .= "}";

        return $output;
    }
}