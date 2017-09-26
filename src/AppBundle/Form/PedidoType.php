<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\PedidosProductos;
use AppBundle\Form\PedidosProductosType;

class PedidoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fecha', DateTimeType::class,
          [
            'label' => 'Fecha',
            'widget' => 'single_text',
          ]
        )
        ->add('total', MoneyType::class,
          [
            'label' => 'Total pedido',
            'attr' =>
            [
              'placeholder' => '0.00'
            ]
          ]
        )
        ->add('comentario', TextType::class,
          [
            'label' => 'Observaciones'
          ]
        )
        ->add('productos', CollectionType::class,
          [
            'entry_type' => PedidosProductosType::class,
            'by_reference' => false,
            'allow_add' => true,
            'allow_delete' => true,
            'label' => false,
          ]
        )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pedido'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_pedido';
    }


}
