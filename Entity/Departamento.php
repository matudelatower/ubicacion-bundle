<?php

namespace Matudelatower\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamentos")
 * @ORM\Entity
 */
class Departamento {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /** @ORM\ManyToOne(targetEntity="Provincia", inversedBy="departamento")
     *  @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

    /**
     * @ORM\OneToMany(targetEntity="Localidad", mappedBy="departamento")
     */
    private $localidad;

    public function __toString() {
        return $this->descripcion;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->localidad = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Departamento
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Departamento
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo() {
        return $this->codigo;
    }


    /**
     * Set provincia
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Provincia $provincia
     * @return Departamento
     */
    public function setProvincia(\Matudelatower\UbicacionBundle\Entity\Provincia $provincia = null) {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Matudelatower\UbicacionBundle\Entity\Provincia
     */
    public function getProvincia() {
        return $this->provincia;
    }

    /**
     * Add localidad
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Localidad $localidad
     * @return Departamento
     */
    public function addLocalidad(\Matudelatower\UbicacionBundle\Entity\Localidad $localidad) {
        $this->localidad[] = $localidad;

        return $this;
    }

    /**
     * Remove localidad
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Localidad $localidad
     */
    public function removeLocalidad(\Matudelatower\UbicacionBundle\Entity\Localidad $localidad) {
        $this->localidad->removeElement($localidad);
    }

    /**
     * Get localidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalidad() {
        return $this->localidad;
    }



}
