<?php

use yii\db\Schema;
use yii\db\Migration;

class m150704_175630_create_table_user extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'user',
            [
                'id' => Schema::TYPE_PK,
                'username' => Schema::TYPE_STRING . ' COMMENT "Логин"',
                'password' => Schema::TYPE_STRING . ' COMMENT "Пароль"',
                'fullname' => Schema::TYPE_STRING . ' COMMENT "Полное имя"',
                'email' => Schema::TYPE_STRING,
                'phone' => Schema::TYPE_STRING . ' COMMENT "Телефон"',
                'role' => Schema::TYPE_STRING . ' NOT NULL' . ' COMMENT "Роль"',
                'cityId' => Schema::TYPE_INTEGER,
                'year' => Schema::TYPE_SMALLINT . ' COMMENT "Год"',
                'authKey' => Schema::TYPE_STRING . ' COMMENT "Ключ авторизации"',
                'disabled' => Schema::TYPE_BOOLEAN . ' COMMENT "Активен?"'
            ],
            'DEFAULT CHARSET UTF8' . ' COMMENT "Пользователи"'
        );
        $this->addForeignKey('user_city_fk', 'user', 'cityId', 'city', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('user_username_idx', 'user', 'username', true);
        $this->createIndex('user_phone_idx', 'user', 'phone', true);
        $this->createIndex('user_email_idx', 'user', 'email', true);

        // WARNING: после применения миграций сменить пароль
        $this->insert(
            'user',
            [
                'username' => 'admin',
                'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
                'fullname' => 'Админ',
                'email' => 'admin@is74.ru',
                'phone' => '+55555555555',
                'role' => 'admin',
                'authKey' => \Yii::$app->security->generateRandomString(),
            ]
        );
        // WARNING: После запуска в продуктив, данные пользователи должны быть удалены!
        $this->insert(
            'user',
            [
                'username' => 'photo',
                'password' => Yii::$app->getSecurity()->generatePasswordHash('photo'),
                'fullname' => 'Фотограф',
                'email' => 'photo@is74.ru',
                'phone' => '+444444444444',
                'role' => 'photo',
                'authKey' => \Yii::$app->security->generateRandomString(),
            ]
        );
        $this->insert(
            'user',
            [
                'username' => 'moder',
                'password' => Yii::$app->getSecurity()->generatePasswordHash('moder'),
                'fullname' => 'Модератор',
                'email' => 'moder@is74.ru',
                'phone' => '+333333333333',
                'role' => 'moder',
                'authKey' => \Yii::$app->security->generateRandomString(),
            ]
        );

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('user');

        return true;
    }
}
