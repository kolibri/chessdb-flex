<?php declare(strict_types=1);

namespace App\Twig;

use App\Entity\Game;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ChessExtension extends \Twig_Extension
{
    private $resolver;

    pubflic function __construct(OptionsResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('string_to_pgn_div', [$this, 'renderStringToPgnDiv'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('game_to_pgn_div', [$this, 'renderGameToPgnDiv'], ['is_safe' => ['html']]),
        ];
    }

    public function renderStringToPgnDiv(string $pgn, array $attributes = [])
    {
        $attributeString = '';
        foreach ($this->parseAttributes($attributes) as $key => $value) {
            $attributeString .= sprintf("%s='%s' ", $key, $value);
        }

        return sprintf('<div %s>%s</div>', $attributeString, $pgn);
    }

    public function renderGameToPgnDiv(Game $game, array $attributes = [])
    {
        return $this->renderStringToPgnDiv($game->getPgn(), $attributes);
    }

    private function parseAttributes(array $options = []): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults(array(
            'disable-custom-moves' => 'false',
            'piece-names' => '',
            'player' => null,
            'ply' => null,
            'reverse' => 'false',
        ));

        $defaultOptions = [
            'data-label-disable-custom-moves' => 'false',
            'data-label-piece-names' => '',
            'data-label-player' => null,
            'data-label-ply' => null,
            'data-label-reverse' => 'false',

//            'data-piece-names' => $this->translator->trans(self::PIECE_NAMES),
            'class' => 'pgn',
        ];

        return array_merge($defaultOptions, $options);
    }
}
