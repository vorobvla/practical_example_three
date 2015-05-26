<?php
/**
 * Created by PhpStorm.
 * User: vova
 * Date: 5/24/15
 * Time: 12:14 AM
 */

namespace Cvut\Fit\BiPwt\BlogBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("text", "textarea", array(
                'label' => 'Text: '
            ))
            ->add('comment', 'submit', array(
                'label' => 'Comment'))
            ->getForm();
    }

    public function getParent()
    {
        return 'form';
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'cvut_fit_bipwt_blogbundle_comment';
    }

}