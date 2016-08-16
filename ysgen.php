<?php

require_once('vendor/autoload.php');
require_once('config.php');

use Ysgen\Src\StructureParser;
use Ysgen\Src\StructureSaver;
use Ysgen\Src\ConsoleHelper;

$consoleHelper = new ConsoleHelper($argv);
$action = isset($argv[2]) ? strtolower($argv[2]) : '';

switch ($action) {
    case 'generate':
        $consoleHelper->generate();
        break;
    case 'save':
        $consoleHelper->save();
        break;
    case 'list':
        $consoleHelper->list();
        break;
    default:
        $consoleHelper->printInterface();
        break;
}
