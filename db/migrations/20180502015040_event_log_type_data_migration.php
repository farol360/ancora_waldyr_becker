<?php

use Phinx\Migration\AbstractMigration;

class EventLogTypeDataMigration extends AbstractMigration
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
        $event_log_types = [
            [
                'id' => 1,
                'slug' => 'create_patient',
                'name' => 'Criação de Paciente',
                'description' => 'Evento de Adição'
            ],
            [
                'id' => 2,
                'slug' => 'edit_patient',
                'name' => 'Edição de Paciente',
                'description' => 'Evento de Edição'
            ],
            [
                'id' => 3,
                'slug' => 'create_professional',
                'name' => 'Adição',
                'description' => 'Evento de Adição'
            ],
            [
                'id' => 4,
                'slug' => 'edit_professional',
                'name' => 'Edição',
                'description' => 'Evento de Edição'
            ],
            [
                'id' => 5,
                'slug' => 'attendance',
                'name' => 'Atendimento',
                'description' => 'Evento de Atendimento'
            ],
            [
                'id' => 6,
                'slug' => 'loan',
                'name' => 'Emprestimo',
                'description' => 'Evento de Empréstimo comodato'
            ],
            [
                'id' => 7,
                'slug' => 'donation_delivered',
                'name' => 'Doação Entregue',
                'description' => 'Evento de Doação'
            ],
            [
                'id' => 8,
                'slug' => 'donation_received',
                'name' => 'Doação Recebida',
                'description' => 'Evento de Doação'
            ],
            [
                'id' => 9,
                'slug' => 'devolution',
                'name' => 'Doação Recebida',
                'description' => 'Evento de Devolução.'
            ]
            [
                'id' => 10,
                'slug' => 'add_product',
                'name' => 'Cadastro de Produto',
                'description' => 'Evento de Adição.'
            ]
            [
                'id' => 11,
                'slug' => 'edit_product',
                'name' => 'Edição de Produto',
                'description' => 'Evento de Edição.'
            ]
        ];
        $this->insert('event_log_types', $event_log_types);

    }
}
