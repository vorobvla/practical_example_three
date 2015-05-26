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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {/*
        $resolver->setDefaults(array(
           // 'data_class' => 'Cvut\Fit\BiPwt\BlogBundle\Entity\File',
        ));*/
    }

    public function getName()
    {
        return 'cvut_fit_bipwt_blogbundle_file';
    }

}