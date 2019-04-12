<?php
/**
 * Created by PhpStorm.
 * User: rashid
 * Date: 12.04.19
 * Time: 12:57
 */

namespace App\Parsers;


use App\LogParser;

abstract class BaseParser{

    protected $instanceLogParser;

    abstract function parse(string $row): array;

    public function setLogParserInstance(LogParser $logParser): void{
        $this->instanceLogParser = $logParser;
    }

}