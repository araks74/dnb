<?php

use yii\db\Schema;
use yii\db\Migration;

class m150704_175553_create_table_city extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'city',
            [
                'id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . ' NOT NULL'
            ],
            'DEFAULT CHARSET UTF8'
        );

        $data = file(Yii::getAlias('@app') . '/data/city.txt');
        foreach ($data as $city) {
            $this->insert('city', ['name' => trim($city)]);
        }

        return true;
    }
    
    public function safeDown()
    {
        $this->dropTable('city');

        return true;
    }
}
