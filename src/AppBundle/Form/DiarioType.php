<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotEqualTo;
use AppBundle\Utils\Turno;

class DiarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['admin']) {
            $disabled=false;
        } else {
            $disabled=$options['activo']; //?false:true;
        }

        $builder
        ->add('fecha', DateType::class, array(
          'widget' => 'single_text',
          'label' => 'Fecha turno',
          'disabled' => $disabled,
        ))
        ->add(
            'turno',
            ChoiceType::class,
            [
                'label' => 'Turno',
                'choices' => Turno::getOptions(),
                'attr' => array('class' => 'chosen-select'),
                'disabled' => $disabled,
            ]
        )
        ->add('colectivo', TextType::class, array(
          'label' => 'Colectivo',
          'disabled' => $disabled,
        ))
        ->add('inicial', MoneyType::class, array(
          'label' => 'Caja inicial',
          'disabled' => $disabled,
          'constraints' => array(
            new NotEqualTo('0')
          ),
          'attr' => array(
            'placeholder' => '0,00',
          )
        ))
        ;
        if ($options['activo']||$options['admin']) {

            $builder
            ->add('final', MoneyType::class, array(
              'label' => 'Caja al cerrar',
              'constraints' => array(
                new NotEqualTo('0')
              ),
              'attr' => array(
                'placeholder' => '0,00',
              )
            ))
            ->add('sobre', MoneyType::class, array(
              'label' => 'Cantidad en sobre',
              'constraints' => array(
                new NotEqualTo('0')
              ),
              'attr' => array(
                'placeholder' => '0,00',
              )
            ))
            ->add('observaciones', TextareaType::class, array(
              'label' => 'Observaciones',
              'attr' => array (
                'rows' => 3,
                'placeholder' => 'Indica al menos si has pedido cervezas o hay que pedirlas',
              )
            ))
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Diario',
            'activo' => false,
            'admin' => false,
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
