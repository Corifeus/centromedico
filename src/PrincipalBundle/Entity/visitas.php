<?php

namespace PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * visitas
 *
 * @ORM\Table(name="visitas")
 * @ORM\Entity(repositoryClass="PrincipalBundle\Repository\visitasRepository")
 */
class visitas
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetimetz")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="pacientes", inversedBy="visitas")
     * @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
    */
    private $pacientes;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return visitas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set paciente
     *
     * @param \PrincipalBundle\Entity\pacientes $paciente
     * @return visitas
     */
    public function setPaciente(\PrincipalBundle\Entity\pacientes $paciente = null)
    {
        $this->pacientes = $paciente;

        return $this;
    }

    /**
     * Get paciente
     *
     * @return \PrincipalBundle\Entity\pacientes 
     */
    public function getPaciente()
    {
        return $this->pacientes;
    }
}
