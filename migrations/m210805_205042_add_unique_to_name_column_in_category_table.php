<?php

use yii\db\Migration;

/**
 * Class m210805_205042_add_unique_to_name_column_in_category_table
 */
class m210805_205042_add_unique_to_name_column_in_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categories', 'name', $this->string(255)->unique()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210805_205042_add_unique_to_name_column_in_category_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210805_205042_add_unique_to_name_column_in_category_table cannot be reverted.\n";

        return false;
    }
    */
}
