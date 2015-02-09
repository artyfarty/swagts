<?php
/**
 * @author artyfarty
 */

namespace SwagTSTests;

use PHPUnit_Framework_TestCase;
use SwagTS\Providers\SwaggerPHP;
use SwagTS\Writer;

class WriterTest extends PHPUnit_Framework_TestCase {
    public function testCrawlDirectory() {
        $w = new Writer(new SwaggerPHP(['directory' => __DIR__ . "/TestClasses", 'resource' => '/']));
        $expected = file_get_contents(__DIR__ . "/ts_out/ns.d.ts");

        $converted = $w->makeModule("TestClasses");

        $this->assertEquals($expected, $converted);
    }
}
