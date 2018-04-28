<?php
declare(strict_types=1);

namespace Farol360\Ancora\Controller\Admin;

use Farol360\Ancora\Controller;
use Farol360\Ancora\Model;
use Farol360\Ancora\Model\EntityFactory;
use Slim\Flash\Messages as FlashMessages;
use Slim\Views\Twig as View;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class PatientController extends Controller
{

    protected $patientModel;
    protected $diseaseModel;
    protected $userModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $patientModel,
        Model $diseaseModel,
        Model $userModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->patientModel = $patientModel;
        $this->diseaseModel = $diseaseModel;
        $this->userModel    = $userModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $patients = $this->patientModel->getAll();

        return $this->view->render($response, 'admin/patient/index.twig', ['patients' => $patients]);
    }

    public function add(Request $request, Response $response): Response
    {
        if (empty($request->getParsedBody())) {
            $diseases = $this->diseaseModel->getAll();
            return $this->view->render($response, 'admin/patient/add.twig', ['diseases' => $diseases]);
        }

        $data = $request->getParsedBody();

        $data['password'] = '1234';
        $data['role_id'] = 1;

        $user = $this->entityFactory->createUser($data);

        $patient['id_user'] = $this->userModel->add($user);
        $patient['id_patient_type'] = 1;
        $patient['id_disease'] = (int) $data['id_disease'];

        $patient = $this->entityFactory->createPatient($patient);

        $this->patientModel->add($patient);

        $this->flash->addMessage('success', 'Paciente adicionado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/patients');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $this->patientModel->delete($id);

        $this->flash->addMessage('success', 'Paciente removido com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/patients');
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $patient = $this->diseaseModel->get($id);
        if (!$patient) {
            $this->flash->addMessage('danger', 'Paciente não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/patients');
        }
        return $this->view->render($response, 'admin/patient/edit.twig', ['patient' => $patient]);
    }

    public function update(Request $request, Response $response): Response
    {
        $patient = $this->entityFactory->createPatient($request->getParsedBody());
        $this->patientModel->update($patient);

        $this->flash->addMessage('success', 'Paciente atualizado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/patients');
    }
}
