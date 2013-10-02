<?php namespace Carbontwelve\Tools\Formatters;

class String
{
	private $string = '';

	/**
	 * -----------------------------------------------------------------------------------------------------------------
	 * Initiate String Class
	 * -----------------------------------------------------------------------------------------------------------------
	 *
     * @todo  throw exception
	 * @param string $string Input string, must validate as a string or an exception is thrown
	 */
	public function __construct( $string )
	{
		$this->string = $string;
	}

    public function getString()
    {
        return $this->string;
    }

    public function setString( $string )
    {
        $this->string = $string;
    }

	/**
     * -----------------------------------------------------------------------------------------------------------------
     * Takes an input and replaces text smiles with image equivolents
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @todo   Test
     * @todo   This needs to not transform $this->string which it does atm
     * @param  string $iconDirectory Path to where emoticons are found
     * @return string
     */
    public function emoticons( $iconDirectory = 'assets/smiles' )
    {

        // Supported icons, this should be supplemented by the app config or something...
        $icons = array(
            'smile' => array(
                'matches' => array(
                    ':)',
                    ':-)',
                ),
                'replace' => '<img src="'. $iconDirectory .'/smile.png" alt="smile" class="smile icon_smile" />'
            ),
            'grin' => array(
                'matches' => array(
                    ':D',
                    ':-D',
                ),
                'replace' => '<img src="'. $iconDirectory .'/grin.png" alt="grin" class="smile icon_grin" />'
            ),
            'tongue' => array(
                'matches' => array(
                    ':p',
                    ':-p',
                    ':P',
                    ':-P'
                ),
                'replace' => '<img src="'. $iconDirectory .'/tongue.png" alt="tongue" class="smile icon_tongue" />'
            ),
            'sad' => array(
                'matches' => array(
                    ':(',
                    ':-('
                ),
                'replace' => '<img src="'. $iconDirectory .'/sad.png" alt="sad face" class="smile icon_sad" />'
            ),
            'wink' => array(
                'matches' => array(
                    ';)',
                    ';-)'
                ),
                'replace' => '<img src="'. $iconDirectory .'/wink.png" alt="wink" class="smile icon_wink" />'
            ),
            'confused' => array(
                'matches' => array(
                    ':s',
                    ':-s',
                    ';s',
                    ';-s'
                ),
                'replace' => '<img src="'. $iconDirectory .'/confused.png" alt="confused" class="smile icon_confused" />'
            ),
            'kwai' => array(
                'matches' => array(
                    ':3',
                    ':-3',
                ),
                'replace' => '<img src="'. $iconDirectory .'/kwai.png" alt="kwai" class="smile icon_kwai" />'
            ),

            'cool' => array(
                'matches' => array(
                    '8)',
                    '8-)',
                ),
                'replace' => '<img src="'. $iconDirectory .'/cool.png" alt="cool" class="smile icon_cool" />'
            ),

            'cry' => array(
                'matches' => array(
                    ':\'(',
                    ':\'-(',
                ),
                'replace' => '<img src="'. $iconDirectory .'/cry.png" alt="cry" class="smile icon_cry" />'
            ),
        );

        // Loop over icons and replace by mask
        // Does not match if at begining of string or end of a line with no space or nl
        foreach($icons as $iconGroup)
        {
            foreach ($iconGroup['matches'] as $mask)
            {
                $icon = preg_quote($mask);
                $this->string = preg_replace("~\s$icon\s~", $iconGroup['replace'], $this->string);
            }
        }

        // Return input with smiles replaced with images
        return $this->string;
    }
}
