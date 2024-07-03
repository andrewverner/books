<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m240702_210814_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable(
            table: '{{%author}}',
            columns: [
                'id' => $this->primaryKey(),
                'name' => $this->string(length: 255)->notNull(),
            ],
            options: 'charset=utf8',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropTable(table: '{{%author}}');
    }
}
