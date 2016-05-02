<?php

namespace Matudelatower\AdministrationBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
//use SMTC\MainBundle\Form\Model\User;


class AddCountryFieldSubscriber implements EventSubscriberInterface {

    private $factory;

    public function __construct(FormFactoryInterface $factory) {
        $this->factory = $factory;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    private function addCityForm($form, $country) {
        $form->add($this->factory->createNamed('country', 'entity', $country, array(
                    'class' => 'UbicacionBundle:Pais',
                    'auto_initialize' => false,
                    'empty_value' => 'Seleccionar',
                    'mapped' => false,
                    'attr' => array(
                        'class' => 'country_selector',
                    ),
                    'query_builder' => function (EntityRepository $repository) {
                $qb = $repository->createQueryBuilder('country');

                return $qb;
            }
        )));
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            $this->addCityForm($form, null);
            return;
        }

        $country = ($data->getCity()) ? $data->getCity()->getCountry() : null;

        $this->addCityForm($form, $country);
    }

    public function preSubmit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $country = array_key_exists('country', $data) ? $data['country'] : null;

        $this->addCityForm($form, $country);
    }

}
