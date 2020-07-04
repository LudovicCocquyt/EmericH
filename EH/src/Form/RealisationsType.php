<?php

namespace App\Form;

use App\Entity\Realisations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class RealisationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('section', ChoiceType::class, [
                        'label'  => 'Type',
                        'choices'=> [
                                       'Intérieur'    => 'Intérieur',
                                       'Terrassement' => 'Terrassement',
                                       'Sol'          => 'Sol',
                                       'Maçonnerie'   => 'Maçonnerie',
                                       'Cloture'      => 'Cloture',
                                       'Divers'       => 'Divers'
                                    ],
                    ])
            ->add('images', FileType::class,[
                'label'    => false,
                'multiple' => true,
                'mapped'   => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Realisations::class,
        ]);
    }
}
