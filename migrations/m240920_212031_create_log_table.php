<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%deeplink}}`
 */
class m240920_212031_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'deeplink_id' => $this->integer()->notNull(),
            'ip' => $this->string(),
        ]);

        // add foreign key for table `{{%deeplink}}`
        $this->addForeignKey(
            '{{%fk-log-deeplink_id}}',
            '{{%log}}',
            'deeplink_id',
            '{{%deeplink}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%deeplink}}`
        $this->dropForeignKey(
            '{{%fk-log-deeplink_id}}',
            '{{%log}}'
        );

        $this->dropTable('{{%log}}');
    }
}
