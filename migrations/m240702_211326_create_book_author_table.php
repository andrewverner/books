<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m240702_211326_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(
            table: '{{%book_author}}',
            columns: [
                'id' => $this->primaryKey(),
                'book_id' => $this->integer()->notNull(),
                'author_id' => $this->integer()->notNull(),
            ],
            options: 'charset=utf8',
        );

        $this->addForeignKey(
            name: 'fk_book_author_book_id',
            table: '{{%book_author}}',
            columns: 'book_id',
            refTable: '{{%book}}',
            refColumns: 'id'
        );

        $this->addForeignKey(
            name: 'fk_book_author_author_id',
            table: '{{%book_author}}',
            columns: 'author_id',
            refTable: '{{%author}}',
            refColumns: 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey(name: 'fk_book_author_author_id', table: '{{%book_author}}');
        $this->dropForeignKey(name: 'fk_book_author_book_id', table: '{{%book_author}}');
        $this->dropTable('{{%book_author}}');
    }
}
