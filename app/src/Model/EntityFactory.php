<?php
declare(strict_types=1);

namespace Farol360\Ancora\Model;

// business objects
use Farol360\Ancora\Model\Attendance;
use Farol360\Ancora\Model\Disease;
use Farol360\Ancora\Model\EventLog;
use Farol360\Ancora\Model\Patient;
use Farol360\Ancora\Model\PatientType;
use Farol360\Ancora\Model\Professional;
use Farol360\Ancora\Model\ProfessionalType;

// Ancora objects
use Farol360\Ancora\Model\Permission;
use Farol360\Ancora\Model\Role;
use Farol360\Ancora\Model\User;

class EntityFactory
{

    // business classes
    public function createAttendance(array $data = []): Attendance
    {
        return new Attendance($data);
    }

    public function createDisease(array $data = []): Disease
    {
        return new Disease($data);
    }

    public function createEventLog(array $data = []): EventLog
    {
        return new EventLog($data);
    }

    public function createPatient(array $data = []): Patient
    {
        return new Patient($data);
    }

    public function createPatientType(array $data = []): PatientType
    {
        return new PatientType($data);
    }

    public function createProfessional(array $data = []): Professional
    {
        return new Professional($data);
    }

    public function createProfessionalType(array $data = []): ProfessionalType
    {
        return new ProfessionalType($data);
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
