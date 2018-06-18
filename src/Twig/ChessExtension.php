<?php declare(strict_types=1);

namespace App\Twig;

use App\Entity\Game;

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
        $defaultOptions = [
            'data-show-buttons' => 'true',
            'data-show-moves' => 'false',
            'data-show-header' => 'true',
            'data-label-next' => '&gt;&gt;',
            'data-label-back' => '&lt;&lt;',
            'data-label-reset' => 'start',
            'data-label-turn' => 'flip',
//            'data-piece-names' => $this->translator->trans(self::PIECE_NAMES),
            'class' => 'pgn',
        ];

        return array_merge($defaultOptions, $options);
    }
}
