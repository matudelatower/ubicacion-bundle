<?php

namespace Matudelatower\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 *
 * @ORM\Table(name="provincias")
 * @ORM\Entity
 */
class Provincia {

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

    /**
     * @ORM\OneToMany(targetEntity="Departamento", mappedBy="provincia")
     */
    private $departamento;

    /** @ORM\ManyToOne(targetEntity="Pais")
     *  @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    private $pais;


    public function __toString() {
        return $this->descripcion;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->departamento = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Provincia
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
     * @return Provincia
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
     * Add departamento
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Departamento $departamento
     * @return Provincia
     */
    public function addDepartamento(\Matudelatower\UbicacionBundle\Entity\Departamento $departamento) {
        $this->departamento[] = $departamento;

        return $this;
    }

    /**
     * Remove departamento
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Departamento $departamento
     */
    public function removeDepartamento(\Matudelatower\UbicacionBundle\Entity\Departamento $departamento) {
        $this->departamento->removeElement($departamento);
    }

    /**
     * Get departamento
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartamento() {
        return $this->departamento;
    }

    /**
     * Set pais
     *
     * @param \Matudelatower\UbicacionBundle\Entity\Pais $pais
     * @return Provincia
     */
    public function setPais(\Matudelatower\UbicacionBundle\Entity\Pais $pais = null) {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \Matudelatower\UbicacionBundle\Entity\Pais
     */
    public function getPais() {
        return $this->pais;
    }

}
