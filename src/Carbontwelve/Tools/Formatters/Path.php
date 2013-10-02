<?php namespace Carbontwelve\Tools\Formatters;

class Path
{
    private $path = '';

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Initiate Path Class
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @param string $path Input string, must validate as a string or an exception is thrown
     */
    public function __construct( $path )
    {
        $this->setPath($path);
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set $this->path
     * @param  string $path Path to be set
     * @throws InvalidPathException If $path is not vallid
     */
    public function setPath( $path )
    {
        // Validate $path, it cant be null and must exist
        if ( ! is_string( $path ) ){ throw new InvalidPathException( 'Path must be of type string' ); }
        if ( is_null( $path ) ){ throw new InvalidPathException( 'Path can not be null' ); }
        if ( ! file_exists( $path )){ throw new InvalidPathException( '('. $path .') is invalid' ); }

        $this->path = $path;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Calculate Folder Size given a $path
     * Note: will not work on remote file systems due to a restriction inherent in php config
     * -----------------------------------------------------------------------------------------------------------------
     *
     * @source http://www.master-script.com/calculate-folder-and-subfolders-size-with-php.html
     * @return bool|int File/Folder size in bytes
     */
    public function size()
    {
        // If $this->path is a file and not a folder return the file size
        // This is used for the recursive nature of this function.
        if ( is_file($this->path) ){ return filesize($this->path); }

        // Init output intiger
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

    /**
     * Count the number of files and folders in $this->path
     */
    public function count()
    {
        if ( is_file($this->path) ){ return 1; }

        $output = 0;

        $path = $this->path;

        $fileList = glob($path."/*");
        if ( $fileList !== false && count($fileList) > 0 ){
            foreach( $fileList as $fileName )
            {
                $this->path = $fileName;
                $output += $this->size();
            }
        }

        $this->path = $path;

        return $output;

    }

}

class InvalidPathException extends \Exception {}
