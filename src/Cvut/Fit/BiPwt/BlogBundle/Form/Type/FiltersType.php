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
use Symfony\Component\Security\Acl\Exception\Exception;

class FiltersType extends AbstractType{

    protected $authors;
    protected $tags;

    function __construct($options)
    {
       /* foreach ($options['authors'] as $a) {
            $this->authors[] = $this->buildForm();
        }*/
        $this->tags = $options['tags'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'authors' => array(),
            'tags' => array(),
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("author", "choice", array(
                'label' => 'Text: ',
                'choices' => $this->authors,
                'placeholder' => 'Any',
                'label' => 'Filter by author: '
            ))/*
            ->add("tag", "choice", array(
                'label' => 'Text: ',
                'choices' => $this->tags,
                'placeholder' => 'Any',
                'label' => 'Filter by tag: '
            ))*/
            ->add('filter', 'submit', array(
                'label' => 'Filter'))
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
        return 'cvut_fit_bipwt_blogbundle_filters';
    }

}