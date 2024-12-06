<?php

namespace App\Form;

use App\Entity\Animator;
use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('description', TextAreaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Salle',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Categorie',
            ])
            ->add('animator', EntityType::class, [
                'class' => Animator::class,
                'choice_label' => 'firstname',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
                'label' => 'Animateur',
            ])
            ->add('start_time', DateType::class, [
                'label' => 'Début',
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form_label'],
            ])
            ->add('end_time', null, [
                'label' => 'Fin',
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
            'data_class' => Event::class,
        ]);
    }
}
