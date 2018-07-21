<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Form\Dto\CreateInvite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateInviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('invited')
            ->add(
                'color',
                ChoiceType::class,
                [
                    'choices' => [
                        'create.invite.color.empty' => '0',
                        'create.invite.color.white' => 'w',
                        'create.invite.color.black' => 'b',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => CreateInvite::class]);
    }
}
