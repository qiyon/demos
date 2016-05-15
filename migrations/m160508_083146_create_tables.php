<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation for table `table`.
 */
class m160508_083146_create_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_info', [
            'id' => $this->primaryKey(),
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'passwd' => Schema::TYPE_STRING,
            'nickname' => Schema::TYPE_STRING,
            'token' => Schema::TYPE_STRING,
            'isadmin' => Schema::TYPE_INTEGER
        ]);
        $this->insert('user_info', [
            'id' => 1,
            'username' => 'admin@admin.com',
            'passwd' => '1a029978c071a13cb55b0917d0c4cfdb',
            'nickname' => 'admin',
            'token' => '-1',
            'isadmin' => 1
        ]);
        $this->createTable('book_lib', [
            'id' => Schema::TYPE_PK,
            'bookname' => Schema::TYPE_STRING,
            'author' => Schema::TYPE_STRING,
            'ISBN' => Schema::TYPE_STRING,
            'pub_house' => Schema::TYPE_STRING,
            'about_link' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING,
            'tags' => Schema::TYPE_STRING,
        ]);
        $this->createTable('agency', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
            'person' => Schema::TYPE_STRING,
            'address' => Schema::TYPE_STRING,
            'telephone' => Schema::TYPE_STRING,
            'worktime' => Schema::TYPE_STRING,
            'coordinate' => Schema::TYPE_STRING,
            'description' => Schema::TYPE_STRING,
        ]);
        $this->createTable('donate', [
            'id' => Schema::TYPE_PK,
            'donatetime' => Schema::TYPE_DATETIME,
            'description' => Schema::TYPE_STRING,
            'bookid' => Schema::TYPE_INTEGER,
            'donorid' => Schema::TYPE_INTEGER,
            'agencyid' => Schema::TYPE_INTEGER
        ]);
        $this->createTable('donate_track', [
            'id' => Schema::TYPE_PK,
            'donateid' => Schema::TYPE_INTEGER,
            'tracktime' => Schema::TYPE_DATETIME,
            'information' => Schema::TYPE_STRING,
            'trackcoordinate' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_info');
        $this->dropTable('book_lib');
        $this->dropTable('agency');
        $this->dropTable('donate');
        $this->dropTable('donate_track');
    }
}
