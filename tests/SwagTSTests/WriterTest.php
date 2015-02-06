<?php
/**
 * @author artyfarty
 */

namespace SwagTSTests;

use PHPUnit_Framework_TestCase;
use SwagTS\Writer;

class WriterTest extends PHPUnit_Framework_TestCase {
    public function testConvertClassSimple() {
        $w = new Writer();
        $expected = file_get_contents(__DIR__ . "/ts_out/single_class.d.ts");

        $converted = $w->convertClass("SwagTSTests\\TestClasses\\SimpleClass");

        $this->assertEquals($expected, $converted);
    }

    public function testCrawlDirectory() {
        $ns = "SwagTSTests\\TestClasses\\";
        $dir = new \DirectoryIterator(__DIR__ . "/TestClasses");

        $w = new Writer();
        $expected = file_get_contents(__DIR__ . "/ts_out/ns.d.ts");

        $converted = $w->crawlDirectory($dir, "TestClasses", "SwagTSTests\\");

        $this->assertEquals($expected, $converted);
    }
}
