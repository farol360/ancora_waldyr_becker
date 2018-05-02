<?php
declare(strict_types=1);

// includes
use Farol360\Ancora\Controller\Admin\IndexController as IndexAdmin;
use Farol360\Ancora\Controller\Admin\DiseaseController as DiseaseAdmin;
use Farol360\Ancora\Controller\Admin\PatientController as PatientAdmin;
use Farol360\Ancora\Controller\Admin\PermissionController as PermissionAdmin;
use Farol360\Ancora\Controller\Admin\ProfessionalController as ProfessionalAdmin;
use Farol360\Ancora\Controller\Admin\ProfessionalTypeController as ProfessionalTypeAdmin;
use Farol360\Ancora\Controller\Admin\RoleController as RoleAdmin;
use Farol360\Ancora\Controller\Admin\UserController as UserAdmin;

use Farol360\Ancora\Controller\PageController as Page;
use Farol360\Ancora\Controller\UserController as User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('[/]', Page::class . ':index');

$app->group('/admin', function () {
    $this->get('[/]', IndexAdmin::class . ':index');

    $this->group('/diseases', function() {
        $this->get('[/]', DiseaseAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', DiseaseAdmin::class . ':add');
        $this->get('/remove/{id:[0-9]+}', DiseaseAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', DiseaseAdmin::class . ':edit');
        $this->post('/update', DiseaseAdmin::class . ':update');
    });

    $this->group('/patients', function() {
        $this->get('[/]', PatientAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', PatientAdmin::class . ':add');
        $this->get('/remove/{id:[0-9]+}', PatientAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', PatientAdmin::class . ':edit');
        $this->map(['GET', 'POST'], '/history/{id:[0-9]+}', PatientAdmin::class . ':history');
        $this->post('/update', PatientAdmin::class . ':update');
        $this->map(['GET', 'POST'],'/verifyUserByEmail', PatientAdmin::class . ':verifyUserByEmail');
    });

    $this->group('/permission', function () {
        $this->get('[/]', PermissionAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', PermissionAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', PermissionAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', PermissionAdmin::class . ':edit');
        $this->post('/update', PermissionAdmin::class . ':update');
    });

    $this->group('/professionals', function() {
        $this->get('[/]', ProfessionalAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', ProfessionalAdmin::class . ':add');
        $this->get('/remove/{id:[0-9]+}', ProfessionalAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', ProfessionalAdmin::class . ':edit');
        $this->map(['GET', 'POST'], '/history/{id:[0-9]+}', ProfessionalAdmin::class . ':history');
        $this->post('/update', ProfessionalAdmin::class . ':update');
        $this->map(['GET', 'POST'],'/verifyUserByEmail', ProfessionalAdmin::class . ':verifyUserByEmail');
    });

    $this->group('/professional_types', function() {
        $this->get('[/]', ProfessionalTypeAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', ProfessionalTypeAdmin::class . ':add');
        $this->get('/remove/{id:[0-9]+}', ProfessionalTypeAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', ProfessionalTypeAdmin::class . ':edit');
        $this->post('/update', ProfessionalTypeAdmin::class . ':update');

    });

    $this->group('/role', function () {
        $this->get('[/]', RoleAdmin::class . ':index');
        $this->map(['GET', 'POST'], '/add', RoleAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', RoleAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', RoleAdmin::class . ':edit');
        $this->post('/update', RoleAdmin::class . ':update');
    });

    $this->group('/user', function () {
        $this->get('[/]', UserAdmin::class . ':index');
        $this->get('/all', UserAdmin::class . ':index');
        $this->get('/export', UserAdmin::class . ':export');
        $this->get('/{id:[0-9]+}', UserAdmin::class . ':view');
        $this->map(['GET', 'POST'], '/add', UserAdmin::class . ':add');
        $this->get('/delete/{id:[0-9]+}', UserAdmin::class . ':delete');
        $this->get('/edit/{id:[0-9]+}', UserAdmin::class . ':edit');
        $this->post('/update', UserAdmin::class . ':update');
    });
});

$app->map(['GET', 'POST'], '/contato', Page::class . ':contato');

$app->get('/obrigado', Page::class . ':contatoObrigado');

$app->group('/users', function () {
    $this->get('/dashboard', User::class . ':dashboard');
    $this->map(['GET', 'POST'], '/profile', User::class . ':profile');
    $this->map(['GET', 'POST'], '/recover', User::class . ':recover');
    $this->map(['GET', 'POST'], '/recover/token/{token}', User::class . ':recoverPassword');
    $this->map(['GET', 'POST'], '/signin', User::class . ':signIn');
    $this->get('/signout', User::class . ':signOut');
    $this->map(['GET', 'POST'], '/signup', User::class . ':signUp');
    $this->get('/verify/{token}', User::class . ':verify');

});
