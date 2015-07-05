<?php

use yii\db\Schema;
use yii\db\Migration;

class m150704_204110_create_table_dict extends Migration
{
    public function safeUp()
    {
        $this->createTable(
            'dictionary',
            [
                'id' => Schema::TYPE_PK,
                'type' => Schema::TYPE_SMALLINT . ' NOT NULL' . ' COMMENT "Тип значения"',
                'value' => Schema::TYPE_STRING . ' NOT NULL' . ' COMMENT "Значение"',
            ],
            'DEFAULT CHARSET UTF8' . ' COMMENT "Словари для автодополнения"'
        );

        $data = file(Yii::getAlias('@app') . '/data/professions.txt');
        foreach ($data as $prof) {
            $this->insert('dictionary', ['type' => 0, 'value' => trim($prof)]);
        }
        $data = file(Yii::getAlias('@app') . '/data/names_male.txt');
        foreach ($data as $name) {
            $this->insert('dictionary', ['type' => 1, 'value' => trim($name)]);
        }
        $data = file(Yii::getAlias('@app') . '/data/names_female.txt');
        foreach ($data as $name) {
            $this->insert('dictionary', ['type' => 1, 'value' => trim($name)]);
        }

        return true;
    }

    public function safeDown()
    {
        $this->dropTable('dictionary');

        return true;
    }
}
