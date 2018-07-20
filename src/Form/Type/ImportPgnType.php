<?php declare(strict_types=1);

namespace App\Form\Type;

use App\Form\Dto\ImportPgn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImportPgnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pgnString', TextareaType::class, ['label' => 'form.import_pgn.label.pgn_string']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => ImportPgn::class]);
    }
}
