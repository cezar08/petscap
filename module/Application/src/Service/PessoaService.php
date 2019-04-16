<?php

namespace Application\Service;


use Application\Entity\PessoaEntity;
use Doctrine\ORM\EntityManager;

class PessoaService
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buscarTodasAsPessoas()
    {
        $pessoas = $this->em
            ->getRepository('Application\Entity\PessoaEntity')
            ->findAll();

        return $pessoas;
    }

    public function salvarPessoa($values)
    {
        $pessoa = new PessoaEntity();
        $pessoa->setNome($values['nome']);
        $pessoa->setCpf($values['cpf']);
        $this->em->persist($pessoa);
        $this->em->flush();
    }

}
