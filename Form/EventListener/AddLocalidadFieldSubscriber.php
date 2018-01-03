<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 24/2/16
 * Time: 5:15 PM
 */

namespace Matudelatower\UbicacionBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AddLocalidadFieldSubscriber implements EventSubscriberInterface
{

    private $factory;
    private $localidad;

    public function __construct(FormFactoryInterface $factory, $localidad = false)
    {
        $this->factory = $factory;
        $this->localidad = $localidad;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    private function addLocalidadForm($form, $localidad, $departamento)
    {

        if ($this->localidad) {
            $localidad = $this->localidad;
            $departamento = $this->localidad->getDepartamento();
        }

        $form->add($this->factory->createNamed('localidad',
            EntityType::class,
            $localidad,
            array(
                'class' => 'UbicacionBundle:Localidad',
                'auto_initialize' => false,
                'placeholder' => 'Seleccionar',
                'mapped' => true,
                'attr' => array(
                    'class' => 'select_localidad select2',
                ),
                'query_builder' => function (EntityRepository $repository) use ($departamento) {
                    $qb = $repository->createQueryBuilder('loc');
                    if ($departamento instanceof \Matudelatower\UbicacionBundle\Entity\Departamento) {
                        $qb->join('loc.departamento', 'departamento')
                            ->where('departamento = :dep')
                            ->setParameter('dep', $departamento);
                    } else {
                        $qb->join('loc.departamento', 'departamento')
                            ->where('departamento.id = :dep')
                            ->setParameter('dep', $departamento);
                    }
                    return $qb;
                }
            )));
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            $this->addLocalidadForm($form, null, null);

            return;
        }

        $accessor = PropertyAccess::createPropertyAccessor();
        $localidad = $accessor->getValue($data, 'localidad');
        $departamento = ($localidad) ? $localidad->getDepartamento() : null;

        $this->addLocalidadForm($form, $localidad, $departamento);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }
        $localidad = array_key_exists('localidad', $data) ? $data['localidad'] : null;
        $departamento = array_key_exists('departamento', $data) ? $data['departamento'] : null;
        $this->addLocalidadForm($form, $localidad, $departamento);
    }

}
