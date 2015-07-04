# Сайт проекта "Дети наше будущее"

## Развёртывание

### Необходимые зависимости

* [Virtualbox](https://www.virtualbox.org/)
* [Vagrant](https://www.vagrantup.com/)

### Развёртывание

```bash
# Получение исходников
git clone https://bitbucket.org/miramir/dnb.git dnb
cd ./dnb

# Создание необходимых файлов
cp ./config/db.examle.php ./config/db.php
cp ./.env.examle ./.env

# Запуск виртуального окружения
vagrant up

# Вход в виртуальное окружение
vagrant ssh

# Запуск команды обновления
cd /var/www/dnb
./vendor/bin/robo update
```

### Обновление

В каталоге проекта выполнить следующие команды
```bash
# Запуск виртуального окружения
vagrant up

# Вход в виртуальное окружение
vagrant ssh

# Запуск команды обновления
cd /var/www/dnb
./vendor/bin/robo update
```

## Стили кодирования

* Для php должен использоваться [PSR1/PSR2](http://www.php-fig.org/psr/psr-2/ru/)
* Для javascript должен использоваться [jQuery Style Guide](http://contribute.jquery.org/style-guide/js/)
* Для шаблонов используем twig - [его стиль кодирования](http://twig.sensiolabs.org/doc/coding_standards.html)
* С остальным разберёмся чуть позже.
* При разработке лучше всего использовать IDE PHPStorm

## Полезные при разработке ссылки

### Yii2

* [Guide](http://www.yiiframework.com/doc-2.0/guide-index.html).
* [API](http://www.yiiframework.com/doc-2.0/index.html).
* Там же есть документация по расширениям.
* Часть русской документации по фреймворку доступна в git репозитории фреймворка по [ссылке](https://github.com/yiisoft/yii2/tree/master/docs/guide-ru)

### Bootstrap

* [Bootstrap3](http://getbootstrap.com/)
* [yii2-bootstrap](http://www.yiiframework.com/doc-2.0/ext-bootstrap-index.html)

### Twig

* [Twig](http://twig.sensiolabs.org/documentation)
* [yii2-twig](http://www.yiiframework.com/doc-2.0/ext-twig-index.html)

### Остальное

* [Font Awesome](http://fortawesome.github.io/Font-Awesome/icons/)
