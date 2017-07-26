<?php

namespace PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * medicos
 *
 * @ORM\Table(name="medicos")
 * @ORM\Entity(repositoryClass="PrincipalBundle\Repository\medicosRepository")
 */
class medicos
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
     * Muchos médicos tienen muchos centros.
     * @ORM\ManyToMany(targetEntity="centrosmedicos", inversedBy="medicos")
     * @ORM\JoinTable(name="medicos_centros
     ")
     */
    private $centrosmedicos;

    public function __construct() 
    {
        $this->centrosmedicos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return medicos
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
     * @return medicos
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
     * Add centrosmedicos
     *
     * @param \PrincipalBundle\Entity\centrosmedicos $centrosmedicos
     * @return medicos
     */
    public function addCentrosmedico(\PrincipalBundle\Entity\centrosmedicos $centrosmedicos)
    {
        $this->centrosmedicos[] = $centrosmedicos;

        return $this;
    }

    /**
     * Remove centrosmedicos
     *
     * @param \PrincipalBundle\Entity\centrosmedicos $centrosmedicos
     */
    public function removeCentrosmedico(\PrincipalBundle\Entity\centrosmedicos $centrosmedicos)
    {
        $this->centrosmedicos->removeElement($centrosmedicos);
    }

    /**
     * Get centrosmedicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCentrosmedicos()
    {
        return $this->centrosmedicos;
    }
}
