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
        if (empty($request->getParsedBody())) {
            return $this->view->render($response, 'admin/suppliers/add.twig');
        }

        $suppliers = $request->getParsedBody();

        $suppliers = $this->entityFactory->createSupplier($request->getParsedBody());

        $this->supplierModel->add($suppliers);



        $this->flash->addMessage('success', 'Fornecedor adicionada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/suppliers'); 
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $this->supplierModel->delete($id);

        $this->flash->addMessage('success', 'Fornecedor removida com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/suppliers'); 
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $suppliers = $this->supplierModel->get($id);
        if (!$suppliers) {
            $this->flash->addMessage('danger', 'Fornecedor não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/suppliers');
        }
        return $this->view->render($response, 'admin/suppliers/edit.twig', ['suppliers' => $suppliers]); 


    }

    public function update(Request $request, Response $response): Response
    {
       $suppliers = $this->entityFactory->createSupplier($request->getParsedBody());
        $this->supplierModel->update($suppliers);

        $this->flash->addMessage('success', 'Fornecedor atualizado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/suppliers'); 
    }
}
