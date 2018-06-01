<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Chess\MoveTransformHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class MovesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(
            new CallbackTransformer(
                function ($value) {
                    return MoveTransformHelper::moveArrayToString($value);
                },
                function ($value) {
                    return MoveTransformHelper::moveStringToArray($value);
                }
            )
        );
    }

    public function getParent()
    {
        return TextareaType::class;
    }
}
