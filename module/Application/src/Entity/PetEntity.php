<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PetEntity
 * @package Application\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="pet")
 */
class PetEntity extends Entity
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
    protected $tipo;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $raca;

    /**
     * @ORM\ManyToOne(targetEntity="PessoaEntity", cascade={"persist"})
     * @ORM\JoinColumn(name="id_pessoa",
     *     referencedColumnName="id")
     *
     * @var PessoaEntity
     */
    protected $dono;

}
