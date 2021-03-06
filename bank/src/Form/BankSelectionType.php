<?php

declare(strict_types=1);

namespace App\Form;

use App\Model\BankSelection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BankSelectionType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxCredit', NumberType::class)
            ->add('initialFee', NumberType::class)
            ->add('Search', SubmitType::class);
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', BankSelection::class);
    }
}