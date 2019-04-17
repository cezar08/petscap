<?php

namespace Application\Controller;

use Application\Service\PessoaService;
use Application\Service\PetService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PetsController extends AbstractActionController
{

    protected $servicePet;

    protected $servicePessoa;

    public function __construct(PetService $servicePet,
                                PessoaService $servicePessoa)
    {
        $this->servicePessoa = $servicePessoa;
        $this->servicePet = $servicePet;
    }

    public function indexAction()
    {

        return new ViewModel([
            'pets' =>
                $this->servicePet->getAll()
        ]);
    }

    public function saveAction()
    {
        $request = $this->getRequest();
        $id = $this->params('id', 0);

        if ($request->isPost()) {
            $values = $request->getPost();
            $values['id'] = $id;
            $this->servicePet->savePet($values);

            return $this->redirect()->toUrl('/pets');
        }

        return new ViewModel(
            [
                'pessoas' =>
                    $this->servicePessoa->buscarTodasAsPessoas()
            ]
        );
    }

    public function delete()
    {

    }
}