<?php
/**
 * @author artyfarty
 */

namespace SwagTSTests;

use PHPUnit_Framework_TestCase;
use SwagTS\Providers\JSONSchema;
use SwagTS\Providers\SwaggerPHP;
use SwagTS\Writer;

class WriterTest extends PHPUnit_Framework_TestCase {
    public function testCrawlDirectory() {
        $p = new SwaggerPHP(['directory' => __DIR__ . "/TestClasses", 'resource' => '/']);
        $w = new Writer($p);
        $expected = file_get_contents(__DIR__ . "/ts_out/ns.d.ts");

        $converted = $w->makeModule("TestClasses");

        $this->assertEquals($expected, $converted);
    }
    public function testJSONSchema() {
        $p = new JSONSchema(['json_schema' => file_get_contents(__DIR__ . "/schemas/timepad.json")]);
        $w = new Writer($p);
        $expected = file_get_contents(__DIR__ . "/ts_out/timepad.d.ts");

        $converted = $w->makeModule("TestClasses");

        $this->assertEquals($expected, $converted);
    }
}
