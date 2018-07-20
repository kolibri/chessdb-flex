<?php declare(strict_types=1);

namespace App\Twig;

use App\Entity\Game;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChessExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('string_to_pgn_div', [$this, 'renderStringToPgnDiv'], ['is_safe' => ['html']]),
            new \Twig_SimpleFilter('game_to_pgn_div', [$this, 'renderGameToPgnDiv'], ['is_safe' => ['html']]),
        ];
    }

    public function renderStringToPgnDiv(string $pgn, array $attributes = [])
    {
        $attributeString = array_map(
            function ($attribute) {
                return sprintf(
                    "%s='%s'",
                    'class' === $attribute['key'] ? $attribute['key'] : 'data-'.$attribute['key'],
                    $attribute['value']
                );
            },
            array_filter(
                $this->parseAttributes($attributes),
                function ($val) {
                    return (bool) $val['value'];
                }
            )
        );

        return sprintf('<div %s>%s</div>', implode(' ', $attributeString), $pgn);
    }

    public function renderGameToPgnDiv(Game $game, array $attributes = [])
    {
        return $this->renderStringToPgnDiv($game->getPgn(), $attributes);
    }

    private function parseAttributes(array $options = []): array
    {
        $resolver = new OptionsResolver();

        $resolver->setDefaults([
            'class' => 'pgn',
            'disable-custom-moves' => 'false',
            'piece-names' => '',
            'player' => null,
            'ply' => null,
            'reverse' => 'false',
        ]);

        $mapable = [];
        foreach ($resolver->resolve($options) as $key => $value) {
            $mapable[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return $mapable;
    }
}
