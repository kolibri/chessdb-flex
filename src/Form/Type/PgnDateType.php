<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Chess\PgnDate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PgnDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(
            new CallbackTransformer(
                function ($value) {
                    return empty($value) ? '????.??.??' : $value->toString();
                },
                function ($value) {
                    return PgnDate::fromString($value);
                }
            )
        );
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
