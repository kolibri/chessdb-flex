<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('event', TextType::class, ['label' => 'form.game.label.event'])
            ->add('site', TextType::class, ['label' => 'form.game.label.site'])
            ->add('date', PgnDateType::class, ['label' => 'form.game.label.date'])
            ->add('round', TextType::class, ['label' => 'form.game.label.round'])
            ->add('white', TextType::class, ['label' => 'form.game.label.white'])
            ->add('black', TextType::class, ['label' => 'form.game.label.black'])
            ->add('result', TextType::class, ['label' => 'form.game.label.result'])
            ->add('moves', MovesType::class, ['label' => 'form.game.label.moves']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Game::class,
                'empty_data' => function (FormInterface $form) {
                    return new Game(
                        $form->get('event')->getData(),
                        $form->get('site')->getData(),
                        $form->get('date')->getData(),
                        $form->get('round')->getData(),
                        $form->get('white')->getData(),
                        $form->get('black')->getData(),
                        $form->get('result')->getData(),
                        $form->get('moves')->getData()
                    );
                },
            ]
        );
    }
}
