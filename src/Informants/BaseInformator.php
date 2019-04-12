<?php
/**
 * Created by PhpStorm.
 * User: rashid
 * Date: 12.04.19
 * Time: 12:43
 */

namespace App\Informants;


use App\LogParser;

abstract class BaseInformator{

    protected $instanceLogParser;

    abstract public function handle(array $row);

    abstract function getResult(): array;

    public function setLogParserInstance(LogParser $logParser): void{
        $this->instanceLogParser = $logParser;
    }

}