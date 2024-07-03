<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m240702_211006_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(
            table: '{{%book}}',
            columns: [
                'id' => $this->primaryKey(),
                'title' => $this->string(length: 255)->notNull(),
                'year' => $this->integer()->notNull(),
                'description' => $this->text()->notNull(),
                'isbn' => $this->string()->notNull(),
                'main_page_image' => $this->string()->notNull(),
            ],
            options: 'charset=utf8',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(table: '{{%book}}');
    }
}
