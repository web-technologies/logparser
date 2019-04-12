<?php
/**
 * Created by PhpStorm.
 * User: Рашид
 * Date: 11.04.2019
 * Time: 22:39
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Informants\TrafficInformator;
use App\LogParser;
use App\Parsers\DefaultParser;
use App\Informants\HttpCodeInformator;
use App\Informants\SearchEngineInformator;
use App\Informants\UrlUniqueInformator;
use App\Informants\ViewInformator;

try{
    $logParser = (new LogParser('access_log'))
        ->addParserHandler(new DefaultParser)
        ->addInformator(new ViewInformator)
        ->addInformator(new UrlUniqueInformator)
        ->addInformator(new TrafficInformator)
        ->addInformator(
            (new SearchEngineInformator)
                ->addEngine('Google', 'google')
                ->addEngine('Bing', 'bing')
                ->addEngine('Baidu', 'baidu')
                ->addEngine('Yandex', 'yandex')
        )
        ->addInformator(new HttpCodeInformator)
        ->parse();

    echo "Результат парсинга:".PHP_EOL;
    print_r($logParser->toJson());
    echo PHP_EOL;

    if($logParser->hasErrors()){
        echo "В процессе парсинга произошли следующие ошибки:".PHP_EOL;
        echo print_r($logParser->getErrors());
    }
}catch (\Throwable $e){
    echo "Произошла критическая ошибка: {$e->getMessage()}".PHP_EOL;
    echo "StackTrace:".PHP_EOL;
    echo "{$e->getTraceAsString()}";
}
