<?php

namespace App\Responses;

class CreateAnimalResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        $this->items['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $this->items['id']])
            ],
            'race' => [
                'href' => route('races.show', ['id' => $this->items['race_id']])
            ],
            'pet-shop' => [
                'href' => route('pet-shops.show', ['id' => $this->items['pet_shop_id']])
            ],
        ];
    }
}
