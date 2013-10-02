<?php namespace Carbontwelve\Tools\Formatters;

class Number
{

	private $number = 0;

	/**
	 * -----------------------------------------------------------------------------------------------------------------
	 * Initiate Number Class
	 * -----------------------------------------------------------------------------------------------------------------
	 *
     * @todo  throw exception
	 * @param float|int $number Input number, must validate as a number or an exception is thrown
	 */
	public function __construct( $number )
	{
		$this->number = $number;
	}

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber( $number )
    {
        $this->number = $number;
    }

	/**
     * -----------------------------------------------------------------------------------------------------------------
     * Takes an input in bytes and returns it in a human readable format.
     * -----------------------------------------------------------------------------------------------------------------
     *
     * I think this is the binary (base 2) definition
     * Original source of this code is within the below link
     *
     * @link   http://jeffreysambells.com/2012/10/25/human-readable-filesize-php
     * @todo   Remove requirement for the @ symbol on return
     * @param  int $decimals
     * @return string
     */
	public function toHumanFileSize( $decimals = 2)
	{
		$size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($this->number) - 1) / 3);
        return sprintf("%.{$decimals}f", $this->number / pow(1024, $factor)) . @$size[$factor];
	}

	/**
     * -----------------------------------------------------------------------------------------------------------------
     * Takes an input number and returns it with the correct suffix for the decimal power
     * -----------------------------------------------------------------------------------------------------------------
     *
     * I think $precision is ignored here, and is equivilant to $decimals on toHumanFileSize I should probably make this
     * consistant across all number methods.
     *
     * @todo   Make this a much more simpler method similar in size to toHumanFileSize
     * @param  int $precision
     * @return string
     */
	public function withSuffix( $precision = 3 )
	{
		$suffixes = array('', 'k', 'm', 'b', 't');
        $suffixIndex = 0;

        while(abs($this->number) >= 1000 && $suffixIndex < sizeof($suffixes))
        {
            $suffixIndex++;
            $this->number /= 1000;
        }

        return (
	        $this->number > 0
	            // precision of 3 decimal places
	            ? floor($this->number * 1000) / 1000
	            : ceil($this->number * 1000) / 1000
        ) . $suffixes[$suffixIndex];
	}

	/**
     * -----------------------------------------------------------------------------------------------------------------
     * Takes an integer input and returns the string representation of it (one = 1, thirty three = 33, etc)
     * I think this has a bug in it...
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @todo   I do not remember why I said this may have a bug in it... ensure that it is solid and amend the above
     * @todo   make this work with any number <= 1 million
     * @source http://stackoverflow.com/a/2112655/1225977
     * @return string
     */
	public function toWords()
	{
		$result = array();
        $tens   = floor($this->number / 10);
        $units  = $this->number % 10;
        $words  = array
	        (
	            'units' => array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eightteen', 'Nineteen'),
	            'tens' => array('', '', 'Twenty', 'Thirty', 'Fourty', 'Fifty', 'Sixty', 'Seventy', 'Eigthy', 'Ninety')
	        );

        if ($tens < 2)
        {
            $result[] = $words['units'][$tens * 10 + $units];
        } else {
            $result[] = $words['tens'][$tens];

            if ($units > 0)
            {
                $result[count($result) - 1] .= '-' . $words['units'][$units];
            }
        }

        if (empty($result[0]))
        {
            $result[0] = 'Zero';
        }

        return trim(implode(' ', $result));
	}

}
