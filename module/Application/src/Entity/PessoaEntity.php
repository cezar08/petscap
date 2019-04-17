<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PessoaEntity
 * @package Application\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="pessoa")
 */
class PessoaEntity extends Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $cpf;

    /**
     * @ORM\OneToMany(targetEntity="PetEntity", mappedBy="dono", cascade={"all"})
     *
     * @var ArrayCollection
     */
    protected $pets;

    public function __construct()
    {
        $this->pets = new ArrayCollection();
    }

}
