<?php

namespace Matudelatower\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidad
 *
 * @ORM\Table(name="localidades")
 * @ORM\Entity(repositoryClass="Matudelatower\UbicacionBundle\Entity\LocalidadRepository")
 */
class Localidad {

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
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=255, nullable=true)
     */
    private $codigoPostal;

    /** @ORM\ManyToOne(targetEntity="Departamento", inversedBy="localidad")
     *  @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    private $departamento;



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
     * @return Localidad
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
     * @return Localidad
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
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return Localidad
     */
    public function setCodigoPostal($codigoPostal) {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string 
     */
    public function getCodigoPostal() {
        return $this->codigoPostal;
    }



}
