<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DiarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('turno', EntityType::class, array(
          'class' => 'AppBundle:Diario',
          'label' => 'Turno'
        ))
        ->add('colectivo', EntityType::class, array(
          'class' => 'AppBundle:Coletivos',
          'label' => 'Colectivo'
        ))
        ->add('inicial', CurrencyType::class, array(
          'label' => 'Caja inicial'
        ))
        ->add('final', CurrencyType::class, array(
          'label' => 'Caja al cerrar'
        ))
        ->add('sobre', CurrencyType::class, array(
          'label' => 'Cantidad en el sobre'
        ))
        ->add('responsable', TextType::class, array(
          'label' => 'El sobre se entrega a'
        ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Diario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_diario';
    }


}
