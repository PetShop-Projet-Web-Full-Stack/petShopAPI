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
        $this->items['race']['_links'] = $this->getRaceLinks();
        $this->items['race']['species']['_links'] = $this->getSpeciesLinks();

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

    private function getRaceLinks(): array
    {
        return [
            'self' => [
                'href' => route('races.show', ['id' => $this->items['race_id']])
            ]
        ];
    }

    private function getSpeciesLinks(): array
    {
        return [
            'self' => [
                'href' => route('species.show', ['id' => $this->items['race']['species']['id']])
            ]
        ];
    }
}