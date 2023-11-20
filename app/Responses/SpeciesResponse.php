<?php

namespace App\Responses;

class SpeciesResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        foreach ($this->items as &$item) {
            $item['_links'] = $this->getItemLinks($item);
        }

        $this->items['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getItemLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('species.show', ['id' => $item['id']])
            ],
        ];
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('species.index')
            ],
            'create' => [
                'href' => route('species.create')
            ]
        ];
    }
}
