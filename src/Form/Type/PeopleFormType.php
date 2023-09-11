<?php

namespace App\Form\Type;

use App\Entity\People;
use App\Form\Model\PeopleDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeopleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('lastName', TextType::class)
            ->add('age', NumberType::class)
            ->add('salary', NumberType::class)
            ->add('type', TextType::class)
            ->add('clubId', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PeopleDto::class,
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