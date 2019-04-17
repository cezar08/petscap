<?php

namespace Application\Service;

use Application\Entity\PetEntity;
use Doctrine\ORM\EntityManager;

class PetService
{

    const ENTITY = 'Application\Entity\PetEntity';

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->em
            ->getRepository(self::ENTITY)
            ->findAll();
    }

    public function savePet($values)
    {
        $pet = new PetEntity();

        if ($values['id'] > 0) {
            $pet = $this->get($values['id']);
        }

        $values['dono'] = $this->em
            ->find(
                'Application\Entity\PessoaEntity',
                $values['dono']);
        $pet->setData($values);
        $this->em->persist($pet);
        $this->em->flush();
    }

    public function delete($id)
    {
        $pet = $this->get($id);
        $this->em->remove($pet);
        $this->em->flush();
    }

    public function get($id)
    {
        return $this->em->find(self::ENTITY, $id);
    }

}
