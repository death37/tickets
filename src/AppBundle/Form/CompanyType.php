<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CompanyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'Raison social',
                    'attr' => array('class' => 'mdl-textfield__input')))
                ->add('address', TextType::class, array('label' => 'Adresse',
                    'attr' => array('class' => 'mdl-textfield__input')))
                ->add('postal', TextType::class, array('label' => 'Code postal',
                    'attr' => array('class' => 'mdl-textfield__input')
                ))
                ->add('city', TextType::class, array('label' => 'Ville',
                    'attr' => array('class' => 'mdl-textfield__input')))
                ->add('phone', TextType::class, array('label' => 'Téléphone',
                    'attr' => array('class' => 'mdl-textfield__input')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Company'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_company';
    }


}
