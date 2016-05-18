<?php

namespace Matudelatower\UbicacionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('codigoPais')
            ->add('codigoArea')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Matudelatower\UbicacionBundle\Entity\Pais'
        ));
    }

    public function getBlockPrefix() {
        return 'matudelatower_ubicacionbundle_pais_type';
    }

    public function getName() {
        return $this->getBlockPrefix();
    }
}
