<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacite',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('establishment', EntityType::class, [
                'label' => 'Etablissement',
                'class' => Establishment::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
