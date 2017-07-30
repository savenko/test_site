<?php

use yii\db\Migration;

class m170729_124520_add_bill_of_lading extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%bill_of_lading}}', [
            'id' => $this->primaryKey(),
            'city_from' => $this->string(150),
            'city_to' => $this->string(150),
            'recipient' => $this->string(150),
            'status_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' =>  $this->integer(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%bill_of_lading}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170729_124520_add_bill_of_ladind cannot be reverted.\n";

        return false;
    }
    */
}
