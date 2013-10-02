<?php

use \Carbontwelve\Tools\Formatters\Path;

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
}
