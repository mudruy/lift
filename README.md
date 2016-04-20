# lift
Php Elevator
=====
Описание<br />
Приложение представляет собой однопоточный сервер на php обрабатывающий одного клиента.<br />
Класс Building реализован для реализации нескольких лифтов, но сейчас обслуживает только один.<br />
После подключения клиент оказывается на лестничной площадке с возможностью выбрать этаж для появления.<br />
После он видит как лифт движеться к нему. После того как лифт приехал - считается что пользователь сел в него.<br />
Можно перемещаться в пределах 1-5 этажей. Выйти из лифта и подключения к серверу можно командой exit.<br />
Затем снова можно зайти на сервер, и лифт приедет на нужный этаж. <br />
Тайминги и порты находяться в константах классов, отдельного конфига не делал.<br />
Для повторного запуска тестов возможно придеться подождать. На macos не отпускает порт сразу.<br />
Потушить сервер лифта можно командой shutdown.<br />
<br />
<br />
<br />

Установка<br />
git clone https://github.com/mudruy/lift.git .<br />
wget https://getcomposer.org/download/1.0.0-alpha11/composer.phar<br />
php composer.phar update<br />

Запуск тестов ./vendor/phpunit/phpunit/phpunit.php --bootstrap vendor/autoload.php tests/<br />
Запуск сервера php run.php<br />
Запуск клиента telnet 127.0.0.1 8787<br />


