<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 2/5/16
 * Time: 12:33 PM
 */

namespace Matudelatower\UbicacionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Matudelatower\UbicacionBundle\Entity\Provincia;


class LoadProvinciaData extends AbstractFixture implements OrderedFixtureInterface {

	public function load( ObjectManager $manager ) {
		$provincias = array(
			array( 'id' => 1, 'nombreProvincia' => 'Buenos Aires', 'id_pais' => 1 ),
			array( 'id' => 2, 'nombreProvincia' => 'Buenos Aires-GBA', 'id_pais' => 1 ),
			array( 'id' => 3, 'nombreProvincia' => 'Capital Federal', 'id_pais' => 1 ),
			array( 'id' => 4, 'nombreProvincia' => 'Catamarca', 'id_pais' => 1 ),
			array( 'id' => 5, 'nombreProvincia' => 'Chaco', 'id_pais' => 1 ),
			array( 'id' => 6, 'nombreProvincia' => 'Chubut', 'id_pais' => 1 ),
			array( 'id' => 7, 'nombreProvincia' => 'Córdoba', 'id_pais' => 1 ),
			array( 'id' => 8, 'nombreProvincia' => 'Corrientes', 'id_pais' => 1 ),
			array( 'id' => 9, 'nombreProvincia' => 'Entre Ríos', 'id_pais' => 1 ),
			array( 'id' => 10, 'nombreProvincia' => 'Formosa', 'id_pais' => 1 ),
			array( 'id' => 11, 'nombreProvincia' => 'Jujuy', 'id_pais' => 1 ),
			array( 'id' => 12, 'nombreProvincia' => 'La Pampa', 'id_pais' => 1 ),
			array( 'id' => 13, 'nombreProvincia' => 'La Rioja', 'id_pais' => 1 ),
			array( 'id' => 14, 'nombreProvincia' => 'Mendoza', 'id_pais' => 1 ),
			array( 'id' => 15, 'nombreProvincia' => 'Misiones', 'id_pais' => 1 ),
			array( 'id' => 16, 'nombreProvincia' => 'Neuquén', 'id_pais' => 1 ),
			array( 'id' => 17, 'nombreProvincia' => 'Río Negro', 'id_pais' => 1 ),
			array( 'id' => 18, 'nombreProvincia' => 'Salta', 'id_pais' => 1 ),
			array( 'id' => 19, 'nombreProvincia' => 'San Juan', 'id_pais' => 1 ),
			array( 'id' => 20, 'nombreProvincia' => 'San Luis', 'id_pais' => 1 ),
			array( 'id' => 21, 'nombreProvincia' => 'Santa Cruz', 'id_pais' => 1 ),
			array( 'id' => 22, 'nombreProvincia' => 'Santa Fe', 'id_pais' => 1 ),
			array( 'id' => 23, 'nombreProvincia' => 'Santiago del Estero', 'id_pais' => 1 ),
			array( 'id' => 24, 'nombreProvincia' => 'Tierra del Fuego', 'id_pais' => 1 ),
			array( 'id' => 25, 'nombreProvincia' => 'Tucumán', 'id_pais' => 1 ),
		);

		foreach ( $provincias as $provincia ) {
			$entidadProv = new Provincia();

			$entidadProv->setDescripcion( $provincia['nombreProvincia'] );
			$entidadProv->setPais( $this->getReference( 'pais' . $provincia['id_pais'] ) );


			$manager->persist( $entidadProv );
			$this->addReference( 'provincia' . $provincia['id'], $entidadProv );
		}


		$manager->flush();
	}

	public function getOrder() {
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 2;
	}

}