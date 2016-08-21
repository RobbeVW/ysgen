<?php

namespace Ysgen\Src;

/**
 * A class providing basic helper functions
 */
class ConsoleHelper
{
    private $argv;


    /**
     * Constructor
     * @param array $argv
     */
    public function __construct($argv)
    {
        $this->argv = $argv;
    }

    /**
     * Generate project structure
     */
    public function generate()
    {
        $argv = $this->argv;

        if (isset($argv[2])) {
            $parser = new StructureParser(TEMPLATES_DIR . '/' . $argv[2] . '.yml');
        } else {
            $parser = new StructureParser();
        }

        $parser->generate();
    }

    /**
     * Save a template
     */
    public function save()
    {
        $argv = $this->argv;

        $overwrite = (isset($argv[3]) && (strtolower($argv[3] === 'overwrite')));
        $saver = new StructureSaver($argv[2], $overwrite);

        $saver->save();
    }

    /**
     * List all saves
     */
    public function list()
    {
        $files = scandir(TEMPLATES_DIR);
        unset($files[0]);
        unset($files[1]);
        echo 'Available template files:' . PHP_EOL;
        echo implode(PHP_EOL, $files);
    }

    /**
     * Print the interface
     */
    public function printInterface()
    {
        $commands = [
            'generate' => [
                'args' => 'optional:name',
                'description' => "Generates a project's structure, uses saved template if name is specified."
            ],
            'save' => [
                'args' => 'name',
                'description' => 'Save a local structure.yml and make it usable globally.'
            ],
            'list' => [
                'args' => '',
                'description' => 'List all globally available templates.'
            ]
        ];

        $lastValue = end($commands);

        foreach ($commands as $key => $value) {
            echo "| $key:\n";
            echo "| Arguments:\t<$value[args]>\n";
            echo "| Description:\t$value[description]\n";
            if ($value != $lastValue) {
                echo "+\n";
            }
        }
    }
}
