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
use Matudelatower\UbicacionBundle\Entity\Pais;


class LoadPaisData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{

		$pais = new Pais();
		$pais->setCodigoArea('54');
		$pais->setCodigoPais('AR');
		$pais->setDescripcion('Argentina');

		$manager->persist($pais);
		$manager->flush();
		$this->addReference('pais' . $pais->getId(), $pais);
	}

	public function getOrder()
	{
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 1;
	}

}