<?php

namespace PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * centrosmedicos
 *
 * @ORM\Table(name="centrosmedicos")
 * @ORM\Entity(repositoryClass="PrincipalBundle\Repository\centrosmedicosRepository")
 */
class centrosmedicos
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     *@ORM\OneToMany(targetEntity="pacientes", mappedBy="centrosmedicos")
    */
    private $pacientes;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="medicos", mappedBy="centrosmedicos")
     */
    private $medicos;

    public function __construct() 
    {
        $this->pacientes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->medicos = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set nombre
     *
     * @param string $nombre
     * @return centrosmedicos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return centrosmedicos
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function __toString()
    {
      return $this->getNombre();
    }


    /**
     * Add pacientes
     *
     * @param \PrincipalBundle\Entity\pacientes $pacientes
     * @return centrosmedicos
     */
    public function addPaciente(\PrincipalBundle\Entity\pacientes $pacientes)
    {
        $this->pacientes[] = $pacientes;

        return $this;
    }

    /**
     * Remove pacientes
     *
     * @param \PrincipalBundle\Entity\pacientes $pacientes
     */
    public function removePaciente(\PrincipalBundle\Entity\pacientes $pacientes)
    {
        $this->pacientes->removeElement($pacientes);
    }

    /**
     * Get pacientes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPacientes()
    {
        return $this->pacientes;
    }

    /**
     * Add medicos
     *
     * @param \PrincipalBundle\Entity\medicos $medicos
     * @return centrosmedicos
     */
    public function addMedico(\PrincipalBundle\Entity\medicos $medicos)
    {
        $this->medicos[] = $medicos;

        return $this;
    }

    /**
     * Remove medicos
     *
     * @param \PrincipalBundle\Entity\medicos $medicos
     */
    public function removeMedico(\PrincipalBundle\Entity\medicos $medicos)
    {
        $this->medicos->removeElement($medicos);
    }

    /**
     * Get medicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicos()
    {
        return $this->medicos;
    }
}
