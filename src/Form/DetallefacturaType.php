<?php

namespace App\Form;

use App\Entity\Detallefactura;
use App\Entity\Producto;
use App\Entity\Factura;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetallefacturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('preciototal')
            ->add('producto', EntityType::class,[
            'class' => Producto::class,
            'choice_label'=> 'nombre'
        ])
            ->add('factura', EntityType::class,[
            'class' => Factura::class,
            'choice_label'=> 'id'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Detallefactura::class,
        ]);
    }
}
