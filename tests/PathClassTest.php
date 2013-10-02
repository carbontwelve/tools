<?php

use Carbontwelve\Tools\Formatters\Path;
use Icecave\Temptation\Temptation;

class PathClassTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Tools\Formatters\Path */
    private $pathClass;

    /**
     * @return void
     */
    public function setUp(){}

    /**
     * @return void
     */
    public function tearDown(){}

    public function testStringSetter()
    {
        $this->pathClass = new Path( 'Hello' );
        $this->assertEquals( 'Hello', $this->pathClass->getPath() );
        $this->pathClass->setPath( 'World' );
        $this->assertEquals( 'World', $this->pathClass->getPath() );
    }

    public function testPathSizeForFile()
    {
        /** @var $temptation Icecave\Temptation\Temptation */
        $temptation = new Temptation;
        $file       = $temptation->createFile();
        file_put_contents($file->path(), 'This is my temp file.');

        $this->pathClass = new Path( $file->path() );
        $this->assertEquals( $file->path(), $this->pathClass->getPath() );
        $this->assertEquals( 21, $this->pathClass->size() );
    }

    public function testPathSizeForDir()
    {
        /** @var $temptation Icecave\Temptation\Temptation */
        $temptation = new Temptation;

        // Need to figure out how to use Temptation to emulate a directory structure filled with files

    }
}
