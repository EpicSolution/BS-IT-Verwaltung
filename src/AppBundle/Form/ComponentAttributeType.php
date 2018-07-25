<?php
declare(strict_types=1);

/*
 * Created by solutionDrive GmbH
 *
 * @copyright 2018 solutionDrive GmbH
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ComponentAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bezeichnung', TextType::class);
        $builder->get('bezeichnung')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $builder = $event->getForm();
                $builder->add('bezeichnung', TextType::class);
            }
        );
    }
}
