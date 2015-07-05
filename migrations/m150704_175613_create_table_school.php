<?php

use yii\db\Schema;
use yii\db\Migration;

class m150704_175613_create_table_school extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'school',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Название школы"',
                'cityId' => Schema::TYPE_INTEGER . ' NOT NULL',
                'year' => Schema::TYPE_SMALLINT . ' COMMENT "Год"',
                'classCount' => Schema::TYPE_INTEGER . ' COMMENT "Количество классов"',
                'childCount' => Schema::TYPE_INTEGER . ' COMMENT "Количество детей"',
                'state' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0' . ' COMMENT "Состояние"',
            ],
            'DEFAULT CHARSET UTF8 COMMENT "Школы"'
        );
        $this->addForeignKey('school_city_fk', 'school', 'cityId', 'city', 'id', 'RESTRICT', 'RESTRICT');

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('school');

        return true;
    }
}
