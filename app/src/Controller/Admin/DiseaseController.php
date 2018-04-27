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



class DiseaseController extends Controller
{

    protected $diseaseModel;

    public function __construct(
        View $view,
        FlashMessages $flash,
        Model $diseaseModel,
        EntityFactory $entityFactory
    ) {
        parent::__construct($view, $flash);
        $this->diseaseModel = $diseaseModel;
        $this->entityFactory = $entityFactory;
    }

    public function index(Request $request, Response $response): Response
    {

        $diseases = $this->diseaseModel->getAll();

        return $this->view->render($response, 'admin/disease/index.twig', ['diseases' => $diseases]);
    }
}
