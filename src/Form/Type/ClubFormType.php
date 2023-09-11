<?php

namespace App\Form\Type;

use App\Entity\Club;
use App\Form\Model\ClubDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('budget', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClubDto::class,
            'csrf_protection' => false
        ]);
    }

    public function getName(){
        return '';
    }

    public function getBlockPrefix()
    {
        return '';
    }
}