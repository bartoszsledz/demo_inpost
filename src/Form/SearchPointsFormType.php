<?php

namespace App\Form;

use App\Validator\PostalCodeRequired;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SearchPointsFormType extends AbstractType
{
    private const POSTAL_CODE_REGEX = '/^\d{2}-\d{3}$/';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'constraints' => [
                    new Assert\Length(['min' => 3, 'max' => 64]),
                ],
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'constraints' => [
                    new Assert\NotNull(),
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3, 'max' => 64]),
                ],
                'required' => true,
            ])
            ->add('postalCode', TextType::class, [
                'constraints' => [
                    new PostalCodeRequired(),
                    new Assert\Regex(self::POSTAL_CODE_REGEX),
                ],
                'required' => false,
            ]);

        $builder->get('city')->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $city = $event->getData();
            if (!empty($city)) {
                $event->setData(ucfirst(strtolower($city)));
            }
        });

        $builder->get('postalCode')->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $postalCode = $event->getData();
            $form = $event->getForm()->getParent();
            if ($form !== null && !empty($postalCode) && preg_match(self::POSTAL_CODE_REGEX, $postalCode)) {
                $form->add('name', TextType::class, ['required' => false]);
            }
        });
    }
}
