# Сайт проекта "Дети наше будущее"

## Развёртывание

### Необходимые зависимости

* Настроенный веб-сервер
* PHP
* MySql сервер

### Настройка веб-сервера (nginx)

```nginx
    server {
        set $yii_bootstrap "index.php";
        charset utf-8;
        client_max_body_size 128M;
    
        listen 127.0.0.1:80;
        server_name dnb.dev;
        root		path_to_project/web;
        index		$yii_bootstrap;
    
        location / {
            index index.php index.html index.htm;
            try_files $uri $uri/ @yii;
        }
    
        location ~* ^.+\.(jpg|jpeg|gif|png|ico|css|txt|js|bmp)$ {
            expires -1;
        }
    
        location @yii {
            include fastcgi.conf;
            fastcgi_pass phpfpm;
            add_header X-Content-Type-Options nosniff;
            fastcgi_param SCRIPT_FILENAME $document_root/index.php;
            fastcgi_param PATH_INFO $fastcgi_script_name;
        }
    
        location ~ \.php$ {
            include fastcgi.conf;
            fastcgi_pass unix:/run/phpfpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        }
    }
```

### Особенности настройки php-окружения

В переменных окружения при разработке должна быть установлена переменная YII_ENV равная 'dev'.

### Первое развёртывание

```php
    composer create-project --repository-url="http://composer.is74.ru" -sdev miramir/dnb dnb
```

### Обновление

Пока через ```git pull``` и руками. Чуть позже будет более просто.

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