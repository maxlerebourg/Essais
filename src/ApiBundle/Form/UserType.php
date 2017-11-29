<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender',ChoiceType::class, array(
                    'choices' => array('Man' => 'Homme', 'Woman' => 'Femme'),
                    'preferred_choices' => array('Man')))
            ->add('firstName')
            ->add('lastName')
            ->add('phone');
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getGender()
    {
        return $this->getBlockPrefix();
    }
    public function getFirstName()
    {
        return $this->getBlockPrefix();
    }
    public function getLastName()
    {
        return $this->getBlockPrefix();
    }
    public function getPhone()
    {
        return $this->getBlockPrefix();
    }
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }



}
