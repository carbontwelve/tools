<?php namespace Carbontwelve\Tools\Formatters;

class Path
{
    private $path = '';

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Initiate Path Class
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @todo  throw exception
     * @param string $path Input string, must validate as a string or an exception is thrown
     */
    public function __construct( $path )
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath( $path )
    {
        $this->path = $path;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Calculate Folder Size given a $path
     * Note: will not work on remote file systems due to a restriction inherent in php config
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @source http://www.master-script.com/calculate-folder-and-subfolders-size-with-php.html
     * @return bool|int
     */
    public function size()
    {
        // If we have no input, return false
        if ( is_null($this->path) ){ return false; }

        // If the $path is invalid, return false
        if ( ! file_exists($this->path)){ return false; }

        // If $path is a file and not a folder return the file size
        // This is used for the recursive nature of this function.
        if ( is_file($this->path) ){ return filesize($this->path); }

        $output = 0;

        // Cache $this->path as we transform it to use within our recursive search
        $path = $this->path;

        // Loop over all the files in a folder and do a sum on their sizes.
        $fileList = glob($path."/*");
        if ( $fileList !== false && count($fileList) > 0 ){
            foreach( $fileList as $fileName )
            {
                $this->path = $fileName;
                $output += $this->size();
            }
        }

        // Restore $this->path
        $this->path = $path;

        return $output;
    }

}
