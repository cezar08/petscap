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
        $id = (int) $this->params('id', 0);

        if ($request->isPost()) {
            $values = $request->getPost()
                ->toArray();
            $values['id'] = $id;
            $this->pessoaService
                ->salvarPessoa($values);

            return $this->redirect()->toUrl("/pessoas");
        }

        $pessoa = null;

        if ($id > 0)
            $pessoa = $this->pessoaService->get($id);

        return new ViewModel(['pessoa' => $pessoa]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params('id');
        $this->pessoaService->delete($id);

        return $this->redirect()->toUrl("/pessoas");
    }
}
















