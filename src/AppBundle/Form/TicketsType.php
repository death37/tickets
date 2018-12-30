<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tickets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TicketsType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', TextType::class, array(
                    'label'=>'Titre : ',
//                    'label_attr' => array('class' => 'mdl-textfield__label'),
//                    'attr'       => array('class' => 'mdl-textfield__input'),
                ))
                ->add('priority', ChoiceType::class, array(
                    'label'=>'Priorité : ',
//                    'label_attr' => array('class' => 'mdl-selectfield__labelgit '),
//                    'attr'       => array('class' => 'mdl-selectfield__select'),
                    'choices' => array('Basse'=>'Basse', 'Normale'=> 'Normale', 'Haute'=>'Haute', 'Urgent'=>'Urgent','Clos'=>'Clos')
                ))
                ->add('state', ChoiceType::class, array(
                    'label'=>'Etat : ',
//                    'attr' => array('class' => 'mdl-textfield__input'),
                    'choices' => array('Nouveau'=>'new', 'Ouvert'=>'open','En attente'=>'pending','En pause'=>'pause','Résolu'=>'solve')
                ))                
                ->add('problem', CKEditorType::class, array(
                    'label'=>'Description : ',
                    'config' => array('toolbar' => 'standard'),   
                ))
                ->add('images', CollectionType::class, array(
                    'entry_type' => ImageType::class,
                    'entry_options' => array('label' => false),
                    'label' => 'image(s) / capture(s) d\'écran : ',
                    'auto_initialize' => true,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'by_reference' => false,
                    'required' => true,
                    'attr' => array(
                        'class' => 'my-selector')
                ))
                ->addEventListener(FormEvents::SUBMIT, array($this, 'onSubmitData'))
                ;
    }

    public function onSubmitData(FormEvent $event) {
        $data = $event->getData();

        $images = $data->getImages();
        
        foreach ($images as $image) {
            $image->setTicketImage($data);
            
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tickets',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'TicketsType';
    }

}
