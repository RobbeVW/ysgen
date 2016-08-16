<?php

namespace Ysgen\Src;

/**
 * The class responsible for saving templates
 */
class StructureSaver
{
    private $name;
    private $file;

    /**
     * Constructor
     * @param string $name The template's name
     * @param string $file (optional) The template file to save
     */
    public function __construct($name, $overwrite = false, $file = './structure.yml')
    {
        $this->name = $name;
        $this->file = $file;
        $this->overwrite = $overwrite;
    }

    /**
     * Saves a template
     */
    public function save()
    {
        $savePath = TEMPLATES_DIR . '/' . $this->name . '.yml';
        
        if (is_file($savePath) && ($this->overwrite === false)) {
            exit($this->name . ': A template with that name already exists. Please use the overwrite option.');
        }

        copy($this->file, $savePath);
    }
}
