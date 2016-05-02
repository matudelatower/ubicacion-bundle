<?php

namespace Matudelatower\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pais
 *
 * @ORM\Table(name="paises")
 * @ORM\Entity
 */
class Pais {

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
     * @ORM\Column(name="codigo_pais", type="string", length=255, nullable=true)
     */
    private $codigoPais;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_area", type="string", length=255)
     */
    private $codigoArea;


    public function __toString() {
        return $this->descripcion;
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
     * @return Pais
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
     * Set codigoPais
     *
     * @param string $codigoPais
     * @return Pais
     */
    public function setCodigoPais($codigoPais) {
        $this->codigoPais = $codigoPais;

        return $this;
    }

    /**
     * Get codigoPais
     *
     * @return string 
     */
    public function getCodigoPais() {
        return $this->codigoPais;
    }

    /**
     * Set codigoArea
     *
     * @param string $codigoArea
     * @return Pais
     */
    public function setCodigoArea($codigoArea) {
        $this->codigoArea = $codigoArea;

        return $this;
    }

    /**
     * Get codigoArea
     *
     * @return string 
     */
    public function getCodigoArea() {
        return $this->codigoArea;
    }

    

}
