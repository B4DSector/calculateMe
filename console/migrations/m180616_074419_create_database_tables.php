<?php

use yii\db\Migration;

/**
 * Class m180616_074419_create_database_tables
 */
class m180616_074419_create_database_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Creation of conacts table
        $this->createTable('contacts', [
            'contact_id' => $this->integer()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_id' => $this->integer()->notNull(),
            'contact_firstname' => $this->string(50)->notNull(),
            'contact_lastname' => $this->string(50)->notNull(),
            'contact_nickname' => $this->string(50),
            'contact_email' => $this->string(),
            'contact_phone_number'=> $this->string()
        ]);
        $this->addForeignKey('cu_ifui', 'contacts', 'user_id', 'user', 'id');
        //Creation of tags table
        $this->createTable('tags', [
            'tag_id' => $this->integer()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_id' => $this->integer()->notNull(),
            'tag_name' => $this->string(50)->notNull(),
            'tag_description' => $this->text(),
        ]);
        $this->addForeignKey('tu_ifui', 'tags', 'user_id', 'user', 'id');
        //Creation of debts table
        $this->createTable('debts', [
            'debt_id' => $this->integer()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull(),
            'debt_amount' => $this->integer()->notNull(),
            'debt_date' => $this->date()->notNull(),
            'debt_ttp' => $this->date(),
            'debt_description' => $this->text()->notNull(),
            'debt_tag_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('debtu_ifui', 'debts', 'user_id', 'user', 'id');
        $this->addForeignKey('debtc_ifcc_i', 'debts', 'contact_id', 'contacts', 'contact_id');
        $this->addForeignKey('debtt_iftt_i', 'debts', 'debt_tag_id', 'tags', 'tag_id');
        //Creation of demands table
        $this->createTable('demands', [
            'demand_id' => $this->integer()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_id' => $this->integer()->notNull(),
            'contact_id' => $this->integer()->notNull(),
            'demand_amount' => $this->integer()->notNull(),
            'demand_date' => $this->date()->notNull(),
            'debt_ttg' => $this->date(),
            'demand_description' => $this->text()->notNull(),
            'demand_tag_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('demandu_ifui', 'demands', 'user_id', 'user', 'id');
        $this->addForeignKey('demandc_ifcc_i', 'demands', 'contact_id', 'contacts', 'contact_id');
        $this->addForeignKey('demandt_iftt_i', 'demands', 'demand_tag_id', 'tags', 'tag_id');
        //Creation of expenses table
        $this->createTable('expenses', [
            'expense_id' => $this->integer()->append('AUTO_INCREMENT PRIMARY KEY'),
            'user_id' => $this->integer()->notNull(),
            'expense_amount' => $this->integer()->notNull(),
            'expense_date' => $this->date()->notNull(),
            'expense_description' => $this->text()->notNull(),
            'expense_tag_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('eu_ifui', 'expenses', 'user_id', 'user', 'id');
        $this->addForeignKey('et_iftt_i', 'expenses', 'expense_tag_id', 'tags', 'tag_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('debts');
        $this->dropTable('demands');
        $this->dropTable('expenses');
        $this->dropTable('contacts');
        $this->dropTable('tags');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180616_074419_create_database_tables cannot be reverted.\n";

        return false;
    }
    */
}
