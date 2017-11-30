<?php
class Template
{
    private $vars = array();       // Holds all the template variables
    private $file;                 // The template file loaded
    
    public function __construct($file = null)
    {
        $this->file = $file;
    }

    /*
     * Set a template variable.
     */
    public function set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    /*
     * Open, parse, and return the template file.
     * @param $file string the template file name
     */
    public function fetch($file = null)
    {
        if(!$file) $file = $this->file;
        extract($this->vars);          // Extract the vars to local namespace
        ob_start();                    // Start output buffering
        include($file);                // Include the file
        return ob_get_clean();         // Return the contents of the buffer        
    }
}
?>