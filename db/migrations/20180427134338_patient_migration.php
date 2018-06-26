<?php

use Phinx\Migration\AbstractMigration;

class PatientMigration extends AbstractMigration
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
        $patients = $this->table('patients');
        $patients->addColumn('id_user', 'integer');
        $patients->addColumn('id_patient_type', 'integer');
        $patients->addColumn('id_disease', 'integer');
        $patients->addColumn('tel_area_2', 'integer', ['null' => true]);
        $patients->addColumn('tel_numero_2', 'integer', ['null' => true]);
        $patients->addColumn('rg', 'string', ['null' => true]);
        $patients->addColumn('sus', 'string', ['null' => true]);
        $patients->addColumn('down', 'integer');
        $patients->addColumn('down_obs', 'string', ['null' => true]);
        $patients->create();

    }
}
