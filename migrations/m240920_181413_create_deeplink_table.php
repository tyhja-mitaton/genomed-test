<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deeplink}}`.
 */
class m240920_181413_create_deeplink_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%deeplink}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'link_id' => $this->string()->unique(),
            'counter' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deeplink}}');
    }
}
