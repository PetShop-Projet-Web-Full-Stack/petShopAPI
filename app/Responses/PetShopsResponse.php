<?php

namespace App\Responses;

class PetShopsResponse
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
                'href' => route('pet-shops.show', ['id' => $item['id']])
            ],
        ];
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('animals.index')
            ],
            'create' => [
                'href' => route('animals.create')
            ]
        ];
    }
}
