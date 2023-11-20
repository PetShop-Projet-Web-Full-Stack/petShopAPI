<?php

namespace App\Responses;

class PetShopResponse {
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        $this->items['_links'] = $this->getLinks();

        foreach ($this->items['animals'] as $key => $animal) {
            $this->items['animals'][$key]['_links'] = $this->getAnimalsLinks($animal['id']);
        }

        return $this->items;
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('pet-shops.show', ['id' => $this->items['id']])
            ]
        ];
    }

    private function getAnimalsLinks(int $id): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $id])
            ]
        ];
    }
}