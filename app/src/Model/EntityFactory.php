<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

// business objects
use Farol360\Ancora\Model\Disease;
use Farol360\Ancora\Model\Patient;
use Farol360\Ancora\Model\PatientType;

// Ancora objects
use Farol360\Ancora\Model\Permission;
use Farol360\Ancora\Model\Role;
use Farol360\Ancora\Model\User;

class EntityFactory
{

    // business classes
    public function createDisease(array $data = []): Disease
    {
        return new Disease($data);
    }

    public function createPatient(array $data = []): Patient
    {
        return new Patient($data);
    }

    public function createPatientType(array $data = []): PatientType
    {
        return new PatientType($data);
    }

    // permission, users and role Classes
    public function createPermission(array $data = []): Permission
    {
        return new Permission($data);
    }

    public function createRole(array $data = []): Role
    {
        return new Role($data);
    }

    public function createUser(array $data = []): User
    {
        return new User($data);
    }
}
