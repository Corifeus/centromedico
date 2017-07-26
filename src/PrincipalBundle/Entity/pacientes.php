<?php

namespace PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * pacientes
 *
 * @ORM\Table(name="pacientes")
 * @ORM\Entity(repositoryClass="PrincipalBundle\Repository\pacientesRepository")
 */
class pacientes
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
     * @ORM\ManyToOne(targetEntity="centrosmedicos", inversedBy="pacientes")
     * @ORM\JoinColumn(name="centromedico_id", referencedColumnName="id")
    */
    private $centrosmedicos;

    /**
     *@ORM\OneToMany(targetEntity="visitas", mappedBy="pacientes")
    */
    private $visitas;


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
     * @return pacientes
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
     * @return pacientes
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
     * Constructor
     */
    public function __construct()
    {
        $this->visitas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set centromedico
     *
     * @param \PrincipalBundle\Entity\centrosmedicos $centromedico
     * @return pacientes
     */
    public function setCentrosmedicos(\PrincipalBundle\Entity\centrosmedicos $centrosmedicos = null)
    {
        $this->centrosmedicos = $centrosmedicos;

        return $this;
    }

    /**
     * Get centromedico
     *
     * @return \PrincipalBundle\Entity\centrosmedicos 
     */
    public function getCentrosmedicos()
    {
        return $this->centrosmedicos;
    }

    /**
     * Add visitas
     *
     * @param \PrincipalBundle\Entity\visitas $visitas
     * @return pacientes
     */
    public function addVisita(\PrincipalBundle\Entity\visitas $visitas)
    {
        $this->visitas[] = $visitas;

        return $this;
    }

    /**
     * Remove visitas
     *
     * @param \PrincipalBundle\Entity\visitas $visitas
     */
    public function removeVisita(\PrincipalBundle\Entity\visitas $visitas)
    {
        $this->visitas->removeElement($visitas);
    }

    /**
     * Get visitas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisitas()
    {
        return $this->visitas;
    }
}
