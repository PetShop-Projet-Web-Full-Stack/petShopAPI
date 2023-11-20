<?php

namespace App\Responses;

class CreateSpeciesResponse
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
                'href' => route('species.show', ['id' => $this->items['id']])
            ]
        ];
    }
}
