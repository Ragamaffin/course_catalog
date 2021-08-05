<?php

use yii\db\Migration;

/**
 * Class m210805_211706_delete_unique_and_notnull_on_image_column_in_categories_table
 */
class m210805_211706_delete_unique_and_notnull_on_image_column_in_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categories', 'image', $this->string(255));
        $this->execute('ALTER TABLE categories DROP CONSTRAINT categories_image_key');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210805_211706_delete_unique_and_notnull_on_image_column_in_categories_table reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210805_211706_delete_unique_and_notnull_on_image_column_in_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
