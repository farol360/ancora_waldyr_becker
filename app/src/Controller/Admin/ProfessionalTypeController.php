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



class ProfessionalTypeController extends Controller
{

    protected $professionalTypeModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $professionalTypeModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->professionalTypeModel = $professionalTypeModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $professional_types = $this->professionalTypeModel->getAll();

        return $this->view->render($response, 'admin/professional_types/index.twig', ['professional_types' => $professional_types]);
    }

    public function add(Request $request, Response $response): Response
    {
        if (empty($request->getParsedBody())) {
            return $this->view->render($response, 'admin/professional_types/add.twig');
        }

        $data = $request->getParsedBody();

        $professional_types = $this->entityFactory->createProfessionalType($data);

        $this->professionalTypeModel->add($professional_types);

        $this->flash->addMessage('success', 'Categoria de Profissional adicionada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professional_types');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);

        $this->professionalTypeModel->delete($id);

        $this->flash->addMessage('success', 'Categoria de Profissional removido com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professional_types');
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $professional_type = $this->professionalTypeModel->get($id);
        if (!$professional_type) {
            $this->flash->addMessage('danger', 'Cargo não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/professional_types');
        }
        return $this->view->render($response, 'admin/professional_types/edit.twig', ['professional_type' => $professional_type]);
    }

    public function update(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();

        $professional_type = $this->entityFactory->createProfessionalType($data);

        $this->professionalTypeModel->update($professional_type);

        $this->flash->addMessage('success', 'Categoria de profissional atualizada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/professional_types');
    }
}
