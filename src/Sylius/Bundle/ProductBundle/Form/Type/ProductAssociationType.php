<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\ProductBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Association form type.
 *
 * @author Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class ProductAssociationType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'sylius_association_type_choice', array(
                'label' => 'sylius.form.association.type',
                'required' => true
            ))
            ->add('product', 'sylius_product_choice', array(
                'label' => 'sylius.form.association.product',
                'required' => true,
                'property_path' => 'associatedObject'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_product_association';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->replaceDefaults(array(
            'empty_data' => function (FormInterface $form) {
                return new $this->dataClass($form->get('product')->getData(), $form->get('type')->getData());
            }
        ));
    }
}
