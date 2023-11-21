<?php

namespace App\Responses;

class CreatePetShopResponse
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
                'href' => route('pet-shops.show', ['id' => $this->items['id']])
            ]
        ];
    }
}
