<?php

use Phinx\Migration\AbstractMigration;

class AttendanceMigration extends AbstractMigration
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
        $event_logs = $this->table('attendances');
        $event_logs->addColumn('id_patient', 'integer', ['null' => true]);
        $event_logs->addColumn('id_professional', 'integer', ['null' => true]);
        $event_logs->addColumn('date', 'timestamp');
        $event_logs->addColumn('description', 'string');
        $event_logs->create();
    }
}
