<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PessoaEntity
 * @package Application\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="pessoa")
 */
class PessoaEntity
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
