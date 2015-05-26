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

class PostType extends AbstractType{


    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('title', 'text')
            ->add('text', 'textarea')
            ->add('files', 'collection', array(
                    'type' => 'file',
                    'label' => "Attachment",
                    'allow_add' => true,
                    'allow_delete' => true)
            )
            ->add('private', 'checkbox', array(
                    'label' => "Publish As Private Post")
            )
            ->add('publishFrom', 'datetime')
            ->add('publishTo', 'datetime', array(
                    'label' => "Publish Till")
            )/*
            ->add('files', 'collection', array(
                'type' => new FileType(),
                'data_class'=> 'Cvut\Fit\BiPwt\BlogBundle\Entity\File'
            ))*/

            ->add('Publish', 'submit');
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
        return 'cvut_fit_bipwt_blogbundle_post';
    }

}