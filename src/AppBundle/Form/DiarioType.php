<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class DiarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fecha', DateType::class, array(
          'widget' => 'single_text',
          'label' => 'Fecha de inicio de turno',
        ))
        ->add('colectivo', TextType::class, array(
          'label' => 'Colectivo',
        ))
        ->add('inicial', MoneyType::class, array(
          'label' => 'Caja inicial',
          'attr' => array(
            'placeholder' => '0,00',
          )
        ))
        ->add('final', MoneyType::class, array(
          'label' => 'Caja al cerrar',
          'attr' => array(
            'placeholder' => '0,00',
          )
        ))
        ->add('sobre', MoneyType::class, array(
          'label' => 'Cantidad en sobre',
          'attr' => array(
            'placeholder' => '0,00',
          )
        ))
        ->add('responsable', TextType::class, array(
          'label' => 'El sobre se entrega a',
        ))
        ->add('observaciones', TextareaType::class, array(
          'label' => 'Observaciones',
          'attr' => array (
            'rows' => 3
          )
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
