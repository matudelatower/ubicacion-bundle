<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:19 PM
 */

namespace Matudelatower\UbicacionBundle\Form\EventListener;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AddPaisFieldSubscriber implements EventSubscriberInterface {

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

	private function addPaisForm( $form, $pais ) {

		$form->add( $this->factory->createNamed( 'pais',
			'entity',
			$pais,
			array(
				'class'           => 'UbicacionBundle:Pais',
				'auto_initialize' => false,
				'empty_value'     => 'Seleccionar',
				'mapped'          => false,
				'attr'            => array(
					'class' => 'select_pais select2',
				),
				'query_builder'   => function ( EntityRepository $repository ) {
					$qb = $repository->createQueryBuilder( 'pais' );

					return $qb;
				}
			) ) );
	}

	public function preSetData( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			$this->addPaisForm( $form, null );

			return;
		}

		$accessor = PropertyAccess::createPropertyAccessor();

		$localidad    = $accessor->getValue( $data, 'localidad' );
		$departamento = ( $localidad ) ? $localidad->getDepartamento() : null;
		$provincia    = ( $departamento ) ? $departamento->getProvincia() : null;
		$pais         = ( $provincia ) ? $provincia->getPais() : null;

		$this->addPaisForm( $form, $pais );
	}

	public function preSubmit( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			return;
		}
		$pais = array_key_exists( 'pais', $data ) ? $data['pais'] : null;
		$this->addPaisForm( $form, $pais );
	}


}