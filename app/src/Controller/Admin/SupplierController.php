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



class SupplierController extends Controller
{

    protected $supplierModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $supplierModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->supplierModel = $supplierModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $suppliers = $this->supplierModel->getAll();

        return $this->view->render($response, 'admin/suppliers/index.twig', ['suppliers' => $suppliers]);
    }

    public function add(Request $request, Response $response): Response
    {
       /* if (empty($request->getParsedBody())) {
            return $this->view->render($response, 'admin/disease/add.twig');
        }

        $disease = $request->getParsedBody();

        $disease = $this->entityFactory->createDisease($request->getParsedBody());

        $this->diseaseModel->add($disease);



        $this->flash->addMessage('success', 'Doença adicionada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/diseases'); */
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
     /*   $id = intval($args['id']);
        $this->diseaseModel->delete($id);

        $this->flash->addMessage('success', 'Doença removida com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/diseases'); */
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
      /*  $id = intval($args['id']);
        $disease = $this->diseaseModel->get($id);
        if (!$disease) {
            $this->flash->addMessage('danger', 'Doença não encontrada.');
            return $this->httpRedirect($request, $response, '/admin/disease');
        }
        return $this->view->render($response, 'admin/disease/edit.twig', ['disease' => $disease]); */
    }

    public function update(Request $request, Response $response): Response
    {
     /*   $disease = $this->entityFactory->createDisease($request->getParsedBody());
        $this->diseaseModel->update($disease);

        $this->flash->addMessage('success', 'Cargo atualizado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/diseases'); */
    }
}
