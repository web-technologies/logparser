# logparser
Имеется обычный http access_log файл.
Требуется написать PHP скрипт, обрабатывающий этот лог и выдающий информацию о нём в json виде.
Требуемые данные: количество хитов/просмотров, количество уникальных url, объем трафика, количество строк всего, количество запросов от поисковиков, коды ответов. Пример лог файла и ожидаемого вывода можно посмотреть здесь: https://gist.github.com/web-technologies/46c6833219dc25e80a10dccc55689138
 
Требования
 
Главное требование — код должен быть production ready. То есть легко читаться сторонним разработчиком, легко поддерживаться при каких-либо изменениях к требованиям в будущем и аккуратно оформлен. Представьте, что вы делаете Pull Request для реальной задачи.  
Также код должен справляться с большим объемом записей. Представьте, что ему будет скормлен лог файл на 1 млрд. строк.
