<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:42
 */

namespace App\Informants;


class HttpCodeInformator extends BaseInformator{

    private $statusesToCounts = [];

    public function handle(array $row){
        if(!isset($row['status']))
            throw new \Exception('status');
        if(!isset($this->statusesToCounts[$row['status']]))
            $this->statusesToCounts[$row['status']] = 0;

        $this->statusesToCounts[$row['status']]++;
    }

    public function getResult(): array{
        return ['statusCodes' => $this->statusesToCounts];
    }
}