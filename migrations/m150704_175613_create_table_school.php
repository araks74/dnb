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
                'name' => Schema::TYPE_STRING . ' NOT NULL',
                'city_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'year' => Schema::TYPE_SMALLINT,
                'class_count' => Schema::TYPE_INTEGER,
                'child_count' => Schema::TYPE_INTEGER,
                'state' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            ],
            'DEFAULT CHARSET UTF8'
        );
        $this->addForeignKey('school_city_fk', 'school', 'city_id', 'city', 'id', 'RESTRICT', 'RESTRICT');

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('school');

        return true;
    }
}
