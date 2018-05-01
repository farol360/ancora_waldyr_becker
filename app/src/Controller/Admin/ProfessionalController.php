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



class ProfessionalController extends Controller
{

    protected $professionalModel;
    protected $professionalTypeModel;
    protected $userModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $professionalModel,
        Model $professionalTypeModel,
        Model $userModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->professionalModel = $professionalModel;
        $this->professionalTypeModel = $professionalTypeModel;
        $this->userModel    = $userModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $professionals = $this->professionalModel->getAll();

        return $this->view->render($response, 'admin/professional/index.twig', ['professionals' => $professionals]);
    }

    public function add(Request $request, Response $response): Response
    {
        if (empty($request->getParsedBody())) {
            $professional_types = $this->professionalTypeModel->getAll();
            return $this->view->render($response, 'admin/professional/add.twig', ['professional_types' => $professional_types]);
        }

        $data = $request->getParsedBody();

        $data['password'] = 'Ancora1337';
        $data['role_id'] = 6;

        if ($this->professionalModel->getByEmail($data['email']) != false) {
            $this->flash->addMessage('success', 'O email já existe. por favor cadastre um email único.');
            return $this->httpRedirect($request, $response, '/admin/professionals/add');
        }

        $user = $this->entityFactory->createUser($data);

        $professional['id_user'] = $this->userModel->add($user);
        $professional['id_professional_type'] = $data['id_professional_type'];

        $professional = $this->entityFactory->createProfessional($professional);


        $this->professionalModel->add($professional);

        $this->flash->addMessage('success', 'Paciente adicionado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professionals');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $professional = $this->professionalModel->get($id);

        $professional = $this->entityFactory->createProfessional($professional);

        if (isset($professional)) {
            $this->userModel->delete((int) $professional->id_user);
            $this->professionalModel->delete((int) $professional->id);
        }

        $this->flash->addMessage('success', 'Profissional removido com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professionals');
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $professional = $this->professionalModel->get($id);
        if (!$professional) {
            $this->flash->addMessage('danger', 'Profissional não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/professionals');
        }

        $professional_types = $this->professionalTypeModel->getAll();

        return $this->view->render($response, 'admin/professional/edit.twig', ['professional' => $professional, 'professional_types' => $professional_types]);
    }

    public function history(Request $request, Response $response): Response {
        return $this->view->render($response, 'admin/professional/history.twig');
    }

    public function update(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();

        var_dump($data);

        $professional['id'] = (int) $data['id'];
        $professional['id_user'] = (int) $data['id_user'];
        $professional['id_professional_type'] = (int) $data['id_professional_type'];
        $professional = $this->entityFactory->createprofessional($professional);

        $user = $data;
        $user['id'] = (int) $data['id_user'];

        $user_old = (array) $this->userModel->get($user['id']);
        $user_new = $user_old =  $user;
        $user_new = $this->entityFactory->createUser($user_new);

        $this->professionalModel->update($professional);
        $this->userModel->update($user_new);

        $this->flash->addMessage('success', 'Professional atualizado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professionals');
    }

    public function verifyUserByEmail (Request $request, Response $response) {
        $data = $request->getParsedBody();

        $return = $this->professionalModel->getByEmail((string)$data['email']);

        if ($return == false) {
            return "false";
        } else {
            return "true";
        }


    }
}
