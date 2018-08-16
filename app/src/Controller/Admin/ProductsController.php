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



class ProductsController extends Controller
{

    protected $productsModel;
    protected $productsTypeModel;

    public function __construct( 
        View $view, 
        FlashMessages $flash,
        Model $productsModel,
        Model $productsTypeModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->productsModel = $productsModel;
        $this->productsTypeModel = $productsTypeModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {
        $products = $this->productsModel->getAll();
        return $this->view->render($response, 'admin/products/index.twig', ['products' => $products]);
    }
    public function add(Request $request, Response $response): Response
    {
        if (empty($request->getParsedBody())) {
            $products_type = $this->productsTypeModel->getAll();
            return $this->view->render($response, 'admin/products/add.twig', ['products_type' => $products_type]);
        }
        $products = $request->getParsedBody();
        $products = $this->entityFactory->createProducts($request->getParsedBody());
        $this->productsModel->add($products);

        $this->flash->addMessage('success', 'Protudo adicionada com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products'); 
    }
    public function delete(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $this->productsModel->delete($id);
        $this->flash->addMessage('success', 'Produto removida com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products'); 
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $id = intval($args['id']);
        $products = $this->productsModel->get($id);
        if (!$products) {
            $this->flash->addMessage('danger', 'Produto não encontrado.');
            return $this->httpRedirect($request, $response, '/admin/products');



        }
         $products_type = $this->productsTypeModel->getAll();
            return $this->view->render($response, 'admin/products/edit.twig', ['products_type' => $products_type]);


    }

    public function update(Request $request, Response $response): Response
    {
       $products = $this->entityFactory->createProducts($request->getParsedBody());
        $this->productsModel->update($products);

        $this->flash->addMessage('success', 'Produto atualizado com sucesso.');
        return $this->httpRedirect($request, $response, '/admin/products'); 





    }
}
