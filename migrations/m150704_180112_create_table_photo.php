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
                'year' => Schema::TYPE_SMALLINT,
                'filename' => Schema::TYPE_STRING,
                'upload_user_id' => Schema::TYPE_INTEGER,
                'school_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
                'class' => Schema::TYPE_STRING,
                'state' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
                'name' => Schema::TYPE_STRING,
                'surname' => Schema::TYPE_STRING,
                'profession' => Schema::TYPE_STRING,
                'agree_wall' => Schema::TYPE_BOOLEAN,
                'width' => Schema::TYPE_INTEGER,
                'height' => Schema::TYPE_INTEGER
            ],
            'DEFAULT CHARSET UTF8'
        );
        $this->addForeignKey('photo_user_fk', 'photo', 'upload_user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('photo_school_fk', 'photo', 'school_id', 'school', 'id', 'RESTRICT', 'RESTRICT');

        return true;

    }
    
    public function safeDown()
    {
        $this->dropTable('photo');
        return true;
    }
}
