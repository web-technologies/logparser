<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:42
 */

namespace App\Informants;


class TrafficInformator extends BaseInformator{

    private $counter = 0;

    public function handle(array $row){
        if(!isset($row['bytes']))
            throw new \Exception('Отсутсвует необходимый параметр');
        if(is_numeric($row['bytes']))
            $this->counter += (int)$row['bytes'];
    }

    public function getResult(): array{
        return ['traffic' => $this->counter];
    }
}