<?php

use app\models\Author;
use yii\db\Migration;

/**
 * Class m240703_164608_create_author_subscription_table
 */
class m240703_164608_create_author_subscription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(
            table: '{{%author_subscription}}',
            columns: [
                'id' => $this->primaryKey(),
                'author_id' => $this->integer()->notNull(),
                'phone' => $this->string(length: 11)->notNull(),
            ],
            options: 'charset=utf8',
        );

        $this->addForeignKey(
            name: 'fk_author_subscription_author_id',
            table: '{{%author_subscription}}',
            columns: 'author_id',
            refTable: Author::tableName(),
            refColumns: 'id',
        );

        $this->createIndex(
            name: 'author_subscription_author_id_phone_unique_idx',
            table: '{{%author_subscription}}',
            columns: ['author_id', 'phone'],
            unique: true,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropIndex(name: 'author_subscription_author_id_phone_unique_idx', table: '{{%author_subscription}}');
        $this->dropForeignKey(name: 'fk_author_subscription_author_id', table: '{{%author_subscription}}');
        $this->dropTable(table: '{{%author_subscription}}');
    }
}
