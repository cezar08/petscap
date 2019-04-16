<?php

namespace Application\Controller;

use Application\Service\PessoaService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PessoasController extends AbstractActionController
{
    protected $pessoaService;

    public function __construct(PessoaService $service)
    {
        $this->pessoaService = $service;
    }

    public function indexAction()
    {
        $pessoas = $this->pessoaService
            ->buscarTodasAsPessoas();

        return new ViewModel([
            'pessoas' => $pessoas
        ]);
    }

    public function saveAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $values = $request->getPost()
                ->toArray();
            $this->pessoaService
                ->salvarPessoa($values);

        }


        return new ViewModel();
    }

    public function deleteAction()
    {

    }

}
















