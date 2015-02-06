<?php
/**
 * @author artyfarty
 */

namespace SwagTS;


use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\DocParser;
use Doctrine\Common\Annotations\Reader;

class AnnotationReader implements Reader {
    /**
     * @var DocParser
     */
    private $parser;

    /**
     * Constructor.
     *
     * Initializes a new SimpleAnnotationReader.
     */
    public function __construct()
    {
        $this->parser = new DocParser();
        $this->parser->setIgnoreNotImportedAnnotations(true);
        $this->parser->setImports(['swg' => 'Swagger\Annotations']);
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotations(\ReflectionClass $class)
    {
        return $this->parser->parse($class->getDocComment(), 'class '.$class->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotations(\ReflectionMethod $method)
    {
        return $this->parser->parse($method->getDocComment(), 'method '.$method->getDeclaringClass()->name.'::'.$method->getName().'()');
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotations(\ReflectionProperty $property)
    {
        return $this->parser->parse($property->getDocComment(), 'property '.$property->getDeclaringClass()->name.'::$'.$property->getName());
    }

    /**
     * {@inheritDoc}
     */
    public function getClassAnnotation(\ReflectionClass $class, $annotationName)
    {
        foreach ($this->getClassAnnotations($class) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getMethodAnnotation(\ReflectionMethod $method, $annotationName)
    {
        foreach ($this->getMethodAnnotations($method) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getPropertyAnnotation(\ReflectionProperty $property, $annotationName)
    {
        foreach ($this->getPropertyAnnotations($property) as $annot) {
            if ($annot instanceof $annotationName) {
                return $annot;
            }
        }

        return null;
    }
}