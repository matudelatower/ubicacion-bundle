<?php

namespace Matudelatower\UbicacionBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AddCityFieldSubscriber implements EventSubscriberInterface {

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

    private function addLocalidadForm($form, $city, $country) {

        $form->add($this->factory->createNamed('city', 'entity', $city, array(
                    'class' => 'LocationBundle:City',
                    'auto_initialize' => false,
                    'empty_value' => 'Select',
                    'attr' => array(
                        'class' => 'city_selector',
                    ),
                    'query_builder' => function (EntityRepository $repository) use ($country) {
                $qb = $repository->createQueryBuilder('city')
                        ->innerJoin('city.country', 'country');
                if ($country instanceof Country) {
                    $qb->where('city.country = :country')
                            ->setParameter('country', $country->getId());
                } elseif (is_numeric($country)) {
                    $qb->where('country.id = :country')
                            ->setParameter('country', $country);
                } else {
                    $qb->where('country.name = :country')
                            ->setParameter('country', null);
                }

                return $qb;
            }
        )));
    }

    public function preSetData(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            $this->addCityForm($form, null, null);
            return;
        }

        $accessor = PropertyAccess::getPropertyAccessor();
        $city = $accessor->getValue($data, 'city');
        //$province = ($city) ? $city->getProvince() : null ;
        //$this->addCityForm($form, $city, $province);
        //$country = ($data->getCity()) ? $data->getCity()->getCountry() : null ;
        $country = ($city) ? $city->getCountry() : null;

        $this->addCityForm($form, $city, $country);
    }

    public function preSubmit(FormEvent $event) {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }


//        $city = array_key_exists('city', $data) ? $data['city'] : null;
//        $this->addCityForm($form, $city, $province);

        $country = array_key_exists('country', $data) ? $data['country'] : null;
        $city = array_key_exists('city', $data) ? $data['city'] : null;
        $this->addCityForm($form, $city, $country);
    }

}
