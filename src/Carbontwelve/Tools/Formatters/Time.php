<?php namespace Carbontwelve\Tools\Formatters;

class Time
{

	private $seconds = 0;

	/**
	 * -----------------------------------------------------------------------------------------------------------------
	 * Initiate Time Class
	 * -----------------------------------------------------------------------------------------------------------------
	 *
     * @todo  throw exception
	 * @param int $seconds Input seconds, must validate as a int or an exception is thrown
	 */
	public function __construct( $seconds )
	{
		$this->seconds = $seconds;
	}

    public function getTime()
    {
        return $this->seconds;
    }

    public function setTime( $seconds )
    {
        $this->seconds = $seconds;
    }

	/**
     * Convert seconds to human readable text.
     *
     * @source http://csl.name/php-secs-to-human-text/
     * @return string
     */
	public function toHuman()
	{
		$units = array(
            "week"   => 7*24*3600,
            "day"    =>   24*3600,
            "hour"   =>      3600,
            "minute" =>        60,
            "second" =>         1,
        );

        // specifically handle zero
        if ( $this->seconds == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($this->seconds / $divisor) ) {
                $s .= "$quot $name";
                $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                $this->seconds -= $quot * $divisor;
            }
        }

        return substr($s, 0, -2);
	}
}
