<?php

use \Carbontwelve\Tools\Formatters\Number;

class NumberClassTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Tools\Formatters\Number */
    private $numberClass;

    /**
     * @return void
     */
    public function setUp(){}

    /**
     * @return void
     */
    public function tearDown(){}

    /** Test that the number is set correctly */
    public function testNumberSetter()
    {
        $this->numberClass = new Number( 1 );
        $this->assertEquals( 1, $this->numberClass->getNumber() );
        $this->numberClass->setNumber( 2 );
        $this->assertEquals( 2, $this->numberClass->getNumber() );
    }

    public function testToHumanFileSize()
    {
        $this->numberClass = new Number( 1 );
        $this->assertEquals( '1.00B', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 1024 );
        $this->assertEquals( '1.00kB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 10240 );
        $this->assertEquals( '10.00kB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 102400 );
        $this->assertEquals( '100.00kB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 1048576 );
        $this->assertEquals( '1.00MB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 1048576 );
        $this->assertEquals( '1.00MB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 1073741824 );
        $this->assertEquals( '1.00GB', $this->numberClass->toHumanFileSize( 2 ) );

        $this->numberClass->setNumber( 1099511627776 );
        $this->assertEquals( '1.00TB', $this->numberClass->toHumanFileSize( 2 ) );

        // This method is broken for any size bigger than 1TB
        //@todo fix
        //$this->numberClass->setNumber( 1125899906842624 );
        //$this->assertEquals( '1.00PB', $this->numberClass->toHumanFileSize( 2 ) );

        //$this->numberClass->setNumber( 1152921504606846976 );
        //$this->assertEquals( '1.00EB', $this->numberClass->toHumanFileSize( 2 ) );

        //$this->numberClass->setNumber( 1180591620717411303424 );
        //$this->assertEquals( '1.00ZB', $this->numberClass->toHumanFileSize( 2 ) );

        //$this->numberClass->setNumber( 1208925819614629174706176 );
        //$this->assertEquals( '1.00YB', $this->numberClass->toHumanFileSize( 2 ) );

    }

    /**
     * Test Suffix upto 100 trillion
     */
    public function testWithSuffix()
    {
        $this->numberClass = new Number( 1 );
        $this->assertEquals( 1, $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 999 );
        $this->assertEquals( 999, $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 1000 );
        $this->assertEquals( '1k', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 5000 );
        $this->assertEquals( '5k', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 10000 );
        $this->assertEquals( '10k', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 100000 );
        $this->assertEquals( '100k', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 1000000 );
        $this->assertEquals( '1m', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 5000000 );
        $this->assertEquals( '5m', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 10000000 );
        $this->assertEquals( '10m', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 100000000 );
        $this->assertEquals( '100m', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 1000000000 );
        $this->assertEquals( '1b', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 5000000000 );
        $this->assertEquals( '5b', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 10000000000 );
        $this->assertEquals( '10b', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 100000000000 );
        $this->assertEquals( '100b', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 1000000000000 );
        $this->assertEquals( '1t', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 5000000000000 );
        $this->assertEquals( '5t', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 10000000000000 );
        $this->assertEquals( '10t', $this->numberClass->withSuffix() );

        $this->numberClass->setNumber( 100000000000000 );
        $this->assertEquals( '100t', $this->numberClass->withSuffix() );

    }

    /** Test number to words up to 99 */
    public function testToWords()
    {
        $this->numberClass = new Number( 0 );
        $this->assertEquals( 'Zero', $this->numberClass->toWords() );

        $this->numberClass = new Number( 1 );
        $this->assertEquals( 'One', $this->numberClass->toWords() );

        $this->numberClass = new Number( 2 );
        $this->assertEquals( 'Two', $this->numberClass->toWords() );

        $this->numberClass = new Number( 4 );
        $this->assertEquals( 'Four', $this->numberClass->toWords() );

        $this->numberClass = new Number( 10 );
        $this->assertEquals( 'Ten', $this->numberClass->toWords() );

        $this->numberClass = new Number( 11 );
        $this->assertEquals( 'Eleven', $this->numberClass->toWords() );

        $this->numberClass = new Number( 22 );
        $this->assertEquals( 'Twenty-Two', $this->numberClass->toWords() );

        $this->numberClass = new Number( 55 );
        $this->assertEquals( 'Fifty-Five', $this->numberClass->toWords() );

        $this->numberClass = new Number( 99 );
        $this->assertEquals( 'Ninety-Nine', $this->numberClass->toWords() );

        // This method only works with number up to 99
        //$this->numberClass = new Number( 100 );
        //$this->assertEquals( 'One-Hundred', $this->numberClass->toWords() );
    }
}
