<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:17 PM
 */

namespace Matudelatower\UbicacionBundle\Form\EventListener;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;


class AddProvinciaFieldSubscriber implements EventSubscriberInterface {

	private $factory;

	public function __construct( FormFactoryInterface $factory ) {
		$this->factory = $factory;
	}

	public static function getSubscribedEvents() {
		return array(
			FormEvents::PRE_SET_DATA => 'preSetData',
			FormEvents::PRE_SUBMIT   => 'preSubmit'
		);
	}

	private function addProvinciaForm( $form, $provincia, $pais ) {

		$form->add( $this->factory->createNamed( 'provincia',
			'entity',
			$provincia,
			array(
				'class'           => 'UbicacionBundle:Provincia',
				'auto_initialize' => false,
				'empty_value'     => 'Seleccionar',
				'mapped'          => false,
				'attr'            => array(
					'class' => 'select_provincia select2',
				),
				'query_builder'   => function ( EntityRepository $repository ) use ( $pais ) {
					$qb = $repository->createQueryBuilder( 'prov' );
					$qb->innerJoin( 'prov.pais', 'pais' )
					   ->where( 'pais = :pais' )
					   ->setParameter( 'pais', $pais );

					return $qb;
				}
			) ) );
	}

	public function preSetData( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			$this->addProvinciaForm( $form, null, null );

			return;
		}

		$accessor  = PropertyAccess::createPropertyAccessor();
		$localidad = $accessor->getValue( $data, 'localidad' );
		$departamento = ( $localidad ) ? $localidad->getDepartamento() : null;
		$provincia = ( $departamento ) ? $departamento->getProvincia() : null;
		$pais      = ( $provincia ) ? $provincia->getPais() : null;

		$this->addProvinciaForm( $form, $provincia, $pais );

	}

	public function preSubmit( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			return;
		}
		$provincia = array_key_exists( 'provincia', $data ) ? $data['provincia'] : null;
		$pais      = array_key_exists( 'pais', $data ) ? $data['pais'] : null;
		$this->addProvinciaForm( $form, $provincia, $pais );
	}

}
