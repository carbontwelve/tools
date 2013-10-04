<?php namespace Carbontwelve\Tools\Services;

use Carbontwelve\Tools\Formatters\Number;
use Carbontwelve\Tools\Formatters\Path;
use Carbontwelve\Tools\Formatters\String;
use Carbontwelve\Tools\Formatters\Time;

class Format
{
    /** @var \Carbontwelve\Tools\Formatters\Number  */
    private $number;
    /** @var \Carbontwelve\Tools\Formatters\Path  */
    private $path;
    /** @var \Carbontwelve\Tools\Formatters\String  */
    private $string;
    /** @var \Carbontwelve\Tools\Formatters\Time  */
    private $time;

    public function __construct()
    {
        $this->number = new Number(0);
        $this->path   = new Path('/');
        $this->string = new String('');
        $this->time   = new Time('');
    }

    /**
     * This is not the best way to do this
     *
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call( $name, $arguments )
    {
        $data = $arguments[0];
        array_shift($arguments);

        if ( method_exists( $this->number, $name ) )
        {
            $this->number->setNumber( $data );
            return call_user_func_array( array( $this->number, $name ), $arguments );
        }

        throw new \Exception( 'The method (' . $name . ') is not valid' );
    }

}
