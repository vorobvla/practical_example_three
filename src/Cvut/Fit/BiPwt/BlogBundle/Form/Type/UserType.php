<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('password', 'password');
        $builder->add('login', 'submit', array('label' => 'Login'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cvut\Fit\BiPwt\BlogBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'cvut_fit_bipwt_blogbundle_login';
    }
}
