<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Evenement;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de l\'événement',
                'placeholder' => 'Ex: Conférence Tech 2025',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le titre est obligatoire']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Le titre doit contenir au moins 3 caractères',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'placeholder' => 'Décrivez l\'événement en détail...',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'La description est obligatoire']),
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'La description doit contenir au moins 10 caractères',
                    ]),
                ],
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date et heure de début',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd\'T\'HH:mm',
                'constraints' => [
                    new Assert\NotNull(['message' => 'La date de début est obligatoire']),
                ],
            ])
            ->add('dateFin', DateTimeType::class, [
                'label' => 'Date et heure de fin',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd\'T\'HH:mm',
                'constraints' => [
                    new Assert\NotNull(['message' => 'La date de fin est obligatoire']),
                ],
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu',
                'placeholder' => 'Ex: Amphithéâtre A - Campus Principal',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le lieu est obligatoire']),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 255,
                        'minMessage' => 'Le lieu doit contenir au moins 3 caractères',
                    ]),
                ],
            ])
            ->add('etablissement', EntityType::class, [
                'label' => 'Établissement',
                'class' => Etablissement::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un établissement',
                'constraints' => [
                    new Assert\NotNull(['message' => 'L\'établissement est obligatoire']),
                ],
            ])
            ->add('utilisateurs', EntityType::class, [
                'label' => 'Participants',
                'class' => Utilisateur::class,
                'choice_label' => function($user) {
                    return $user->getPrenom() . ' ' . $user->getNom();
                },
                'multiple' => true,
                'required' => false,
                'help' => 'Ctrl+Clic pour sélectionner plusieurs participants',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image de l\'événement',
                'mapped' => false,
                'required' => false,
                'attr' => ['accept' => 'image/*'],
                'help' => 'Formats acceptés: JPG, PNG, GIF, WEBP (max 5 Mo)',
                'constraints' => [
                    new Assert\File([
                        'maxSize' => '5M',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp'],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPG, PNG, GIF, WEBP)',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
