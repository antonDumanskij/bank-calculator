<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\Bank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CreateBankType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('interestRate', NumberType::class)
            ->add('maxCredit', NumberType::class)
            ->add('initialFee', NumberType::class)
            ->add('term', NumberType::class)
            ->add('isPublic', \Symfony\Component\Form\Extension\Core\Type\CheckboxType::class, ['required' => false,])
            ->add('Save', SubmitType::class);
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Bank::class);
    }
}