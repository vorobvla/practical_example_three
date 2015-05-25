<?php

namespace Cvut\Fit\BiPwt\BlogBundle\Form\Type;

use Cvut\Fit\BiPwt\BlogBundle\BlogRoles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('password', 'text');
        $builder->add('roles', new RoleType());
        $builder->add('login', 'submit', array('label' => 'Register'));
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
