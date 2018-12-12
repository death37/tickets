<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;




class TicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
                    'label'=>'Titre',
                    'label_attr' => array('class' => 'mdl-textfield__label'),
                    'attr'       => array('class' => 'mdl-textfield__input'),
                ))
                ->add('priority', ChoiceType::class, array(
                    'label'=>'Priorité',
                    'label_attr' => array('class' => 'mdl-selectfield__label'),
                    'attr'       => array('class' => 'mdl-selectfield__select'),
                    'choices' => array('Basse'=>'low', 'Normale'=> 'normal', 'Haute'=>'high', 'Urgent'=>'urgent','Clos'=>'close')
                ))
                ->add('state', ChoiceType::class, array(
                    'label'=>'Etat',
                    'attr' => array('class' => 'mdl-textfield__input'),
                    'choices' => array('Nouveau'=>'new', 'Ouvert'=>'open','En attente'=>'pending','En pause'=>'pause','Résolu'=>'solve')
                    
                ))
                ->add('imageFile', CollectionType::class, array(
                    'entry_type' => VichImageType::class,
                    
                    'auto_initialize' => true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'attr' => array(
                        'class' => 'my-selector')
                ))
//                ->add('imageFile', VichImageType::class, array(
//                    'required' => false,
//                    'allow_delete' => true,
//                    'download_uri' => true,
//                    'image_uri' => true,
//                ))
                
                ->add('problem', TextareaType::class, array(
                    'label'=>'Problème rencontré',
                    'attr' => array('class' => 'mdl-textfield__input')
                    ))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tickets'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'TicketsType';
    }


}
