<?php

namespace App\Responses;

class AnimalsResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        foreach ($this->items as &$item) {
            $item['_links'] = $this->getItemLinks($item);
            $item['race']['_links'] = $this->getRaceItemsLinks($item);
            $item['race']['species']['_links'] = $this->getSpeciesItemsLinks($item);
        }

        $this->items['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getItemLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $item['id']])
            ],
        ];
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('pet-shops.index')
            ],
            'create' => [
                'href' => route('pet-shops.create')
            ]
        ];
    }

    private function getRaceItemsLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('races.show', ['id' => $item['race']['id']])
            ],
            'create' => [
                'href' => route('races.create')
            ]
        ];
    }

    private function getSpeciesItemsLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('species.show', ['id' => $item['race']['species']['id']])
            ],
            'create' => [
                'href' => route('species.create')
            ]
        ];
    }
}
