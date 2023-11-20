<?php

namespace App\Responses;

class AnimalResponse {
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        $this->items['_links'] = $this->getLinks();
        $this->items['pet_shop']['_links'] = $this->getAnimalLinks();

        return $this->items;
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $this->items['id']])
            ]
        ];
    }

    private function getAnimalLinks(): array
    {
        return [
            'self' => [
                'href' => route('pet-shops.show', ['id' => $this->items['pet_shop_id']])
            ]
        ];
    }
}