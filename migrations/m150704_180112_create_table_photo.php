<?php

use yii\db\Schema;
use yii\db\Migration;

class m150704_180112_create_table_photo extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'photo',
            [
                'id' => Schema::TYPE_PK,
                'year' => Schema::TYPE_SMALLINT . ' COMMENT "Год"',
                'filename' => Schema::TYPE_STRING . ' COMMENT "Имя файла"',
                'uploadUserId' => Schema::TYPE_INTEGER . ' COMMENT "Id загрузившего"',
                'schoolId' => Schema::TYPE_INTEGER . ' NOT NULL',
                'type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0' . ' COMMENT "Тип"',
                'class' => Schema::TYPE_STRING . ' COMMENT "Класс (буква или цифра)"',
                'state' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0' . ' COMMENT "Состояние"',
                'name' => Schema::TYPE_STRING . ' COMMENT "Имя"',
                'surname' => Schema::TYPE_STRING . ' COMMENT "Фамилия"',
                'profession' => Schema::TYPE_STRING . ' COMMENT "Профессия"',
                'agree_wall' => Schema::TYPE_BOOLEAN . ' COMMENT "Согласие на печать на баннере"',
                'width' => Schema::TYPE_INTEGER . ' COMMENT "Ширина"',
                'height' => Schema::TYPE_INTEGER . ' COMMENT "Высота"'
            ],
            'DEFAULT CHARSET UTF8' . ' COMMENT "Фотографии"'
        );
        $this->addForeignKey('photo_user_fk', 'photo', 'uploadUserId', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('photo_school_fk', 'photo', 'schoolId', 'school', 'id', 'RESTRICT', 'RESTRICT');

        return true;

    }

    public function safeDown()
    {
        $this->dropTable('photo');

        return true;
    }
}
