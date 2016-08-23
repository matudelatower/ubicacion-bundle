<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:18 PM
 */

namespace Matudelatower\UbicacionBundle\Form\EventListener;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;


class AddDepartamentoFieldSubscriber implements EventSubscriberInterface {

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

	private function addDepartamentoForm( $form, $departamento, $provincia ) {

		$form->add( $this->factory->createNamed( 'departamento',
			'entity',
			$departamento,
			array(
				'class'           => 'UbicacionBundle:Departamento',
				'auto_initialize' => false,
				'empty_value'     => 'Seleccionar',
				'mapped'          => false,
				'attr'            => array(
					'class' => 'select_departamento select2',
				),
				'query_builder'   => function ( EntityRepository $repository ) use ( $provincia ) {
					$qb = $repository->createQueryBuilder( 'dep' );
					if ( $provincia instanceof \Matudelatower\UbicacionBundle\Entity\Provincia ) {
						$qb->join( 'dep.provincia', 'provincia' )
						   ->where( 'provincia = :loc' )
						   ->setParameter( 'loc', $provincia );
					}
					else {
						$qb->join( 'dep.provincia', 'provincia' )
						   ->where( 'provincia.id = :loc' )
						   ->setParameter( 'loc', $provincia );
					}

					return $qb;
				}
			) ) );
	}

	public function preSetData( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			$this->addDepartamentoForm( $form, null, null );

			return;
		}

		$accessor     = PropertyAccess::createPropertyAccessor();
		$localidad    = $accessor->getValue( $data, 'localidad' );
		$departamento = ( $localidad ) ? $localidad->getDepartamento() : null;
		$provincia    = ( $departamento ) ? $departamento->getProvincia() : null;

		$this->addDepartamentoForm( $form, $departamento, $provincia );
	}

	public function preSubmit( FormEvent $event ) {
		$data = $event->getData();
		$form = $event->getForm();

		if ( null === $data ) {
			return;
		}
		$departamento = array_key_exists( 'departamento', $data ) ? $data['departamento'] : null;
		$provincia    = array_key_exists( 'provincia', $data ) ? $data['provincia'] : null;
		$this->addDepartamentoForm( $form, $departamento, $provincia );
	}

}
