<?php

namespace Application\Service;

use Application\Entity\PessoaEntity;
use Doctrine\ORM\EntityManager;

class PessoaService
{
    const ENTITY = 'Application\Entity\PessoaEntity';
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buscarTodasAsPessoas()
    {
        $pessoas = $this->em
            ->getRepository(self::ENTITY)
            ->findAll();

        return $pessoas;
    }

    public function salvarPessoa($values)
    {
        $pessoa = new PessoaEntity();

        if ($values['id'] > 0)
            $pessoa = $this->get($values['id']);

        $pessoa->setData($values);
        $this->em->persist($pessoa);
        $this->em->flush();
    }

    public function get($id)
    {
        return $this->em
            ->find(self::ENTITY,
                $id);
    }

    public function delete($id)
    {
        $pessoa = $this->get($id);
        $this->em->remove($pessoa);
        $this->em->flush();
    }
}
