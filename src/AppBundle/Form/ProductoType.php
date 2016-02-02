<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Producto;
use Symfony\Component\Validator\Constraints\Choice;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',  TextType::class)

            ->add('descripcion', TextType::class)
            ->add('precio',      NumberType::class)
            ->add('disponible',  ChoiceType::class, Array(
                'choices' => array(
                    'Disponible' => true ,
                    'No Disponible' => false  ,
                ),
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Producto',
            ]
        );
    }
    public function getName()
    {
        return 'app_bundle_producto_type';
    }
}