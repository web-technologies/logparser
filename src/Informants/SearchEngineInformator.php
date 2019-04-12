<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 23:42
 */

namespace App\Informants;


class SearchEngineInformator extends BaseInformator{

    private $engineToLike = [
//        'Google' => 'google',
//        'Bing' => 'bing',
//        'Baidu' => 'baidu',
//        'Yandex' => 'yandex'
    ];
    private $enginesToCounts = [];

    public function handle(array $row){
        if(!isset($row['userAgent']))
            throw new \Exception('Отсутсвует необходимый параметр');
        foreach ($this->engineToLike as $engine => $like) {
            if(!isset($this->enginesToCounts[$engine])){
                $this->enginesToCounts[$engine] = 0;
            }
            if(stripos($row['userAgent'], $like) !== false){
                $this->enginesToCounts[$engine]++;
            }
        }

    }

    public function addEngine($engine, $like){
        if(isset($this->engineToLike[$engine]))
            throw new \Exception('Повторное добавление поискового движка, внимательно проверьте корректность кода');
        if(empty($engine) || !is_string($engine))
            throw new \Exception('Параметр "engine" не может быть пустым и должен быть строкового типа');
        if(empty($like) || !is_string($like))
            throw new \Exception('Параметр "like" не может быть пустым и должен быть строкового типа');
        $this->engineToLike[$engine] = $like;
        return $this;


    }

    public function getResult(): array{
        return ['crawlers' => $this->enginesToCounts];
    }
}