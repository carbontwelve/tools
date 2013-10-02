<?php

use \Carbontwelve\Tools\Formatters\Time;

class TimeClassTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Tools\Formatters\Time */
    private $timeClass;

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
        $this->timeClass = new Time( 1 );
        $this->assertEquals( 1, $this->timeClass->getTime() );
        $this->timeClass->setTime( 60 );
        $this->assertEquals( 60, $this->timeClass->getTime() );
    }

    /**
     * Test to Human method up to 1 week, this method will work beyond that but only return in weeks,
     * hours, minutes and seconds
     */
    public function testToHuman()
    {
        $this->timeClass = new Time( 1 );
        $this->assertEquals( '1 second', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 2 );
        $this->assertEquals( '2 seconds', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 60 );
        $this->assertEquals( '1 minute', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 120 );
        $this->assertEquals( '2 minutes', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 3600 );
        $this->assertEquals( '1 hour', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 7200 );
        $this->assertEquals( '2 hours', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 86400 );
        $this->assertEquals( '1 day', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 172800 );
        $this->assertEquals( '2 days', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 604740 );
        $this->assertEquals( '6 days, 23 hours, 59 minutes', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 604741 );
        $this->assertEquals( '6 days, 23 hours, 59 minutes, 1 second', $this->timeClass->toHuman() );

        $this->timeClass = new Time( 604800 );
        $this->assertEquals( '1 week', $this->timeClass->toHuman() );

    }
}
