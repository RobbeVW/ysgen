<?php

namespace Ysgen\Src;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * The class responsible for translating Yaml files to directories
 */
class StructureParser
{
    private $structure;

    /**
     * Constructor
     * @param string $path (optional) The structure file's path
     */
    public function __construct($path = './structure.yml')
    {
        $this->structure = self::getParsedYmlContent($path);
    }

    public static function getParsedYmlContent($path)
    {
        if (!is_readable($path)) {
            exit('Could not read file: ' . $path);
        }

        $ymlContent = file_get_contents($path);

        try {
            $parsedYml = Yaml::parse($ymlContent);
        } catch (ParseException $e) {
            exit('Could not parse .yml file: ' . $e->getMessage());
        }

        return $parsedYml;
    }

    /**
     * Create a new folder
     * @param string $path The folder's path
     */
    private static function addFolder($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }

    /**
     * Create a new file
     * @param string $path    The file's path
     * @param string $content (optional) The file's content
     */
    private static function addFile($path, $content = '')
    {
        file_put_contents($path, $content);
    }

    /**
     * array_walk callback
     */
    private static function walk($item, $key, $path)
    {
        $path = $path . '/' . $key;

        if (is_array($item)) {
            self::addFolder($path);
            array_walk($item, 'self::walk', $path);
        } elseif (strpos($key, '.')) {
            self::addFile($path, $item);
        } else {
            self::addFolder($path);
        }
    }

    /**
    * Parse and generate content from a .yml file
    * @param  string $path (optional) The path to generate the structure in
     */
    public function generate($path = '.')
    {
        $structure = $this->structure;
        array_walk($structure, 'self::walk', $path);
    }
}
