<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/25/15
 * Time: 8:53 PM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Form\Type;


use Cvut\Fit\BiPwt\BlogBundle\BlogRoles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RoleType extends AbstractType{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                BlogRoles::ROLE_READER => 'Reader',
                BlogRoles::ROLE_AUTHOR => 'Author',
                BlogRoles::ROLE_ADMIN => 'Administrator',
            ),
            'multiple' => true,
        )
        );
    }

    public function getParent()
    {
        return 'choice';
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'cvut_fit_bipwt_blogbundle_role';
    }

}