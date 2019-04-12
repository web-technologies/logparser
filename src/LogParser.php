<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 22:43
 */

namespace App;


use App\Informants\BaseInformator;
use App\Parsers\BaseParser;

class LogParser{
    private $informants = [];
    private $parser;
    private $filepath;
    private $errors = [];
    private $result = [];
    public function __construct($filepath){
        if(empty($filepath))
            throw new \Exception("Не указан файл!");
        $this->filepath = $filepath;
    }

    public function addInformator(BaseInformator $informator){
        $informator->setLogParserInstance($this);
        $this->informants[] = $informator;
        return $this;
    }
    public function addParserHandler(BaseParser $parser){
        $parser->setLogParserInstance($this);
        $this->parser = $parser;
        return $this;
    }

    public function parse(){
        foreach ($this->readLn() as $line) {
            if($parsedLine = $this->parser->parse($line)){
                foreach ($this->informants as $informant) {
                    $informant->handle($parsedLine);
                }
            }
        }
        $this->buildResult();
        return $this;
    }

    public function setFilepath($filepath){
        $this->filepath = $filepath;
        return $this;
    }

    public function addError($error){
        //Ставим ограничение на логирование ошибок, если их слишком много, значит глобально что то нетак
        if(count($this->errors) <= 2000)
            $this->errors[] = $error;
    }

    public function hasErrors(){
        return (bool)count($this->errors);
    }

    public function getErrors(){
        return $this->errors;
    }

    public function toJson(){
        return json_encode($this->result);
    }

    public function getResult(){
        return $this->result;
    }

    private function buildResult(){
        foreach ($this->informants as $informant) {
            $this->result = array_merge($this->result, $informant->getResult());
        }
    }

    function readLn() {
        $handle = fopen($this->filepath, "r");
        while(!feof($handle)) {
            yield trim(fgets($handle));
        }
        fclose($handle);
    }
}