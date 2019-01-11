<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',null,array('required' => false ))
                ->add('description',null,array('required' => false ))
                ->add('body', null, array('required' => false ))
                ->add('slug', null, array('required' => false ))
                ->add('datePublish',DateType::class,array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime()))
                ->add('categories',EntityType::class,array(
                    'class' =>'AdminBundle:Category' ,
                    'choice_label'=>'libelle',
                    'expanded'=>false ,
                    'multiple'=>true,
                    'required' => false))
                ->add('image',FileType::class, array(
                    'label' => 'image png ou jpeg' , 
                    'data_class' => null,
                    'required' => false));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_post';
    }


}
