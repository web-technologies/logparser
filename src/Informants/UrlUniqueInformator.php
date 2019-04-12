<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:42
 */

namespace App\Informants;


class UrlUniqueInformator extends BaseInformator{

    private $counter = 0;
    private $urls = [];

    public function handle(array $row){
        if(!isset($row['request']))
            throw new \Exception("Отсутсвует необходимый параметр");
        $request = explode(' ', $row['request']);
        if(isset($request[1]) && empty($this->urls[$request[1]]))
            $this->urls[$request[1]] = 1;

    }

    public function getResult(): array{
        return ['urls' => array_sum($this->urls)];
    }
}