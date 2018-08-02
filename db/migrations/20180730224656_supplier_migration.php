<?php

use Phinx\Migration\AbstractMigration;

class SupplierMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $suppliers = $this->table('suppliers');
        $suppliers->addColumn('name', 'string');
        $suppliers->addColumn('description', 'string',['null' => true]);
        $suppliers->addColumn('email', 'string',['null' => true]);
        $suppliers->addColumn('ddd', 'string',['null' => true]);
        $suppliers->addColumn('telefone', 'string',['null' => true]);
        $suppliers->create();
    }
}
