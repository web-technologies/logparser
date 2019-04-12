<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:33
 */

namespace App\Parsers;

class DefaultParser extends BaseParser{

    private $pattern = '|(?P<host>[^\s]+) (?P<logname>[^\s]+) (?P<user>[^\s]+) (?P<time>\[[^\]]+\]) (?P<request>"[^"]+") (?P<status>\d+) (?P<bytes>[^\s]+) ((?P<param1>[^\s]+) )?((?P<param2>[^\s]+) )?(?P<referrer>"[^"]+") (?P<userAgent>"[^"]+")|';

    public function parse(string $row): array {
        $output = [];
        $matches = [];
        if($countMatches = preg_match_all($this->pattern, $row, $matches)){
            $output = [
                'host' => $matches['host'][0],
                'logname' => $matches['logname'][0],
                'user' => $matches['user'][0],
                'time' => $matches['time'][0],
                'request' => $matches['request'][0],
                'status' => $matches['status'][0],
                'bytes' => $matches['bytes'][0],
                'referrer' => $matches['referrer'][0],
                'userAgent' => $matches['userAgent'][0],
            ];

        }else
            $this->instanceLogParser->addError('Не удалось распарсить строку: '.$row);
        return $output;
    }


    public function getPattern(){
        return $this->pattern;
    }


    public function setPattern($pattern){
        $this->pattern = $pattern;
        return $this;
    }
}