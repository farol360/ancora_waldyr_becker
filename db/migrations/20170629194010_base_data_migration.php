<?php

use Phinx\Migration\AbstractMigration;

class BaseDataMigration extends AbstractMigration
{
    public function up()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'guest',
                'description' => 'Visitante',
                'access_level' => 0
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'description' => 'Administrador',
                'access_level' => 900
            ],
            [
                'id' => 3,
                'name' => 'root',
                'description' => 'Super Usuário',
                'access_level' => 1000
            ],
            [
                'id' => 4,
                'name' => 'user',
                'description' => 'Cliente',
                'access_level' => 500
            ],
            [
                'id' => 5,
                'name' => 'patient',
                'description' => 'Paciente',
                'access_level' => 50
            ],
            [
                'id' => 6,
                'name' => 'professional',
                'description' => 'Profissionais',
                'access_level' => 100
            ]
        ];
        $this->insert('roles', $roles);

        $permissions = [
            [
                'resource' => '/',
                'description' => 'Página inicial',
                'role_id' => 1
            ],
            [
                'resource' => '/users/signin',
                'description' => 'Sign in',
                'role_id' => 1
            ],
            [
                'resource' => '/users/signout',
                'description' => 'Sign out',
                'role_id' => 1
            ],
            [
                'resource' => '/users/signup',
                'description' => 'Sign up',
                'role_id' => 1
            ],
            [
                'resource' => '/admin',
                'description' => 'Página administrativa',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances',
                'description' => 'Administração de Atendimentos.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances/:id',
                'description' => 'Detalhes do atendimento.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances/add',
                'description' => 'Administração de Atendimentos - add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances/edit/:id',
                'description' => 'Administração de Atendimentos - edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances/update',
                'description' => 'Administração de Atendimentos - edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/attendances/remove/:id',
                'description' => 'Administração de Atendimentos - remover.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/diseases',
                'description' => 'Administração de Doenças.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/diseases/add',
                'description' => 'Administração de Doenças -Add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/diseases/edit/:id',
                'description' => 'Administração de Doenças - Edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/diseases/remove/:id',
                'description' => 'Administração de Doenças - Remove.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/diseases/update',
                'description' => 'Administração de Doenças - update.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients',
                'description' => 'Administração de Pacientes.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/add',
                'description' => 'Administração de Pacientes -Add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/edit/:id',
                'description' => 'Administração de Pacientes - Edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/history/:id',
                'description' => 'Histórico de Eventos do Paciente.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/remove/:id',
                'description' => 'Administração de Pacientes - Remove.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/update',
                'description' => 'Administração de Pacientes - update.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/patients/verifyUserByEmail',
                'description' => 'Verificar se o usuário existe pelo email.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/permission',
                'description' => 'Ver permissões',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/permission/add',
                'description' => 'Adicionar permissão',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/permission/delete/:id',
                'description' => 'Apagar permissão',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/permission/edit/:id',
                'description' => 'Editar permissão',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/permission/update',
                'description' => 'Atualizar permissão',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/professionals',
                'description' => 'Administração de Profissionais.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/add',
                'description' => 'Administração de profossionais -Add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/edit/:id',
                'description' => 'Administração de Profossionais - Edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/history/:id',
                'description' => 'Histórico de eventos do profissional.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/remove/:id',
                'description' => 'Administração de Profissionais - Remove.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/update',
                'description' => 'Administração de Profossionais - update.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professionals/verifyUserByEmail',
                'description' => 'Verificar se o profissional existe pelo email.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professional_types',
                'description' => 'Administração de Cargos Profissionais.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professional_types/add',
                'description' => 'Administração de Cargos profossionais -Add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professional_types/edit/:id',
                'description' => 'Administração de Cargos Profossionais - Edit.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professional_types/remove/:id',
                'description' => 'Administração de Cargos Profissionais - Remove.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/professional_types/update',
                'description' => 'Administração de Cargos Profossionais - update.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/suppliers',
                'description' => 'Fabricantes',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/suppliers/add',
                'description' => 'Fabricantes -Add.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/suppliers/edit/:id',
                'description' => 'Fabricantes',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/suppliers/remove/:id',
                'description' => 'Fabricantes -Remove.',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/suppliers/update',
                'description' => 'Fabricantes - update',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/role',
                'description' => 'Ver cargos',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/role/add',
                'description' => 'Adicionar cargo',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/role/delete/:id',
                'description' => 'Apagar cargo',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/role/edit/:id',
                'description' => 'Editar cargo',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/role/update',
                'description' => 'Atualizar cargo',
                'role_id' => 3,
            ],
            [
                'resource' => '/admin/sobre',
                'description' => 'Sobre o sistema',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user',
                'description' => 'Ver usuários',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/all',
                'description' => 'Ver todos os usuários',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/:id',
                'description' => 'Ver usuário',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/add',
                'description' => 'Adicionar usuário',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/delete/:id',
                'description' => 'Apagar usuário',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/edit/:id',
                'description' => 'Editar usuário',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/update',
                'description' => 'Atualizar usuário',
                'role_id' => 2,
            ],
            [
                'resource' => '/admin/user/export',
                'description' => 'Exportar usuários',
                'role_id' => 2,
            ],
            [
                'resource' => '/users/profile',
                'description' => 'Ver perfil',
                'role_id' => 4,
            ],
            [
                'resource' => '/users/dashboard',
                'description' => 'Painel do usuário',
                'role_id' => 4,
            ],
            [
                'resource' => '/users/recover',
                'description' => 'Recuperar conta',
                'role_id' => 1,
            ],
            [
                'resource' => '/users/recover/token/:token',
                'description' => 'Recuperar conta',
                'role_id' => 1,
            ],
            [
                'resource' => '/users/verify/:token',
                'description' => 'Verificar conta',
                'role_id' => 1,
            ],
            [
                'resource' => '/contato',
                'description' => 'Página de contato',
                'role_id' => 1,
            ],
            [
                'resource' => '/obrigado',
                'description' => 'Página agradecimento de contato',
                'role_id' => 1,
            ]
        ];
        $this->insert('permissions', $permissions);

        $password = password_hash('1234', PASSWORD_DEFAULT);
        $users = [
            [
                'id' => 1,
                'email' => 'root@localhost',
                'name' => 'Super Usuário',
                'password' => $password,
                'role_id' => 3,
                'active' => 1,
            ],
            [
                'id' => 2,
                'email' => 'admin@localhost',
                'name' => 'Administrador',
                'password' => $password,
                'role_id' => 2,
                'active' => 1,
            ],
            [
                'id' => 3,
                'email' => 'admin@fapcancer.com.br',
                'name' => 'Administrador',
                'password' => $password,
                'role_id' => 2,
                'active' => 1,
            ]
        ];
        $this->insert('users', $users);
    }

    public function down()
    {
        $this->execute('DELETE FROM roles');
        $this->execute('DELETE FROM permissions');
        $this->execute('DELETE FROM users');
    }
}
