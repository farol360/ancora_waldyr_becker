<?php

use Phinx\Migration\AbstractMigration;

class PatientStatusData extends AbstractMigration
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
    public function up() {
        $patient_status = [
            [
                'id' => 1,
                'name' => 'Ativo',

            ],
            [
                'id' => 2,
                'name' => 'Óbito',

            ],
            [
                'id' => 3,
                'name' => 'Afastado',

            ],
        ];

        $this->insert('patient_status', $patient_status);
    }
}
