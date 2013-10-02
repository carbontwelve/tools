<?php

use \Carbontwelve\Tools\Formatters\String;

class StringClassTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Tools\Formatters\String */
    private $stringClass;

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
        $this->stringClass = new String( 'Hello' );
        $this->assertEquals( 'Hello', $this->stringClass->getString() );
        $this->stringClass->setString( 'World' );
        $this->assertEquals( 'World', $this->stringClass->getString() );
    }
}
