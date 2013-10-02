<?php

use Carbontwelve\Tools\Formatters\Path\InvalidPathException;
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

        /** @var $temptation Icecave\Temptation\Temptation */
        $temptation = new Temptation;
        $file       = $temptation->createFile();

        $this->pathClass = new Path( $file->path() );
        $this->assertEquals( $file->path(), $this->pathClass->getPath() );

        $file2      = $temptation->createFile();

        $this->pathClass->setPath( $file2->path() );
        $this->assertEquals( $file2->path(), $this->pathClass->getPath() );
    }

    /**
     * @expectedException Carbontwelve\Tools\Formatters\InvalidPathException
     */
    public function testStringSetterThrowsExceptionOnNullInput()
    {
        $this->pathClass = new Path( null );
    }

    /**
     * @expectedException Carbontwelve\Tools\Formatters\InvalidPathException
     */
    public function testStringSetterThrowsExceptionOnEmptyInput()
    {
        $this->pathClass = new Path( '' );
    }

    /**
     * @expectedException Carbontwelve\Tools\Formatters\InvalidPathException
     */
    public function testStringSetterThrowsExceptionOnInvalidInput()
    {
        $this->pathClass = new Path( 'Hello world!' );
    }

    /**
     * @expectedException Carbontwelve\Tools\Formatters\InvalidPathException
     */
    public function testStringSetterThrowsExceptionOnNonStringInput()
    {
        $this->pathClass = new Path( 1234567890 );
    }

    /**
     * Test that the path size method works for files
     */
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

    /**
     * Need to figure out how to use Temptation to emulate a directory structure filled with files
     */
    public function testPathSizeForDir()
    {
        /** @var $temptation Icecave\Temptation\Temptation */
        $temptation = new Temptation;
    }
}
