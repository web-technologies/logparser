<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:42
 */

namespace App\Informants;


class ViewInformator extends BaseInformator{

    private $counter = 0;

    public function handle(array $row){
        $this->counter++;
    }

    public function getResult(): array{
        return ['views' => $this->counter];
    }
}