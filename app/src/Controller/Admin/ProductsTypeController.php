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



class ProductsTypeController extends Controller
{

    protected $productsTypeModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $productsTypeModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->productsTypeModel = $productsTypeModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $products_type = $this->productsTypeModel->getAll();

        return $this->view->render($response, 'admin/products_type/index.twig', ['products_type' => $products_type]);
    }

    public function add(Request $request, Response $response): Response
    {
        if (empty($request->getParsedBody())) {
            return $this->view->render($response, 'admin/products_type/add.twig');
        }

        $data = $request->getParsedBody();

        $products_type = $this->entityFactory->createProductsType($data);

        $this->productsTypeModel->add($products_type);

        $this->flash->addMessage('success', 'Categoria de Produto adicionada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products_type');
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);

        $this->productsTypeModel->delete($id);

        $this->flash->addMessage('success', 'Categoria de Produto removido com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products_type');
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $products_type = $this->productsTypeModel->get($id);
        if (!$products_type) {
            $this->flash->addMessage('danger', 'Cargo não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/products_type');
        }
        return $this->view->render($response, 'admin/products_type/edit.twig', ['products_type' => $products_type]);
    }

    public function update(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();

        $products_type = $this->entityFactory->createProductsType($data);

        $this->productsTypeModel->update($products_type);

        $this->flash->addMessage('success', 'Categoria de produto atualizada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products_type');
    }
}
