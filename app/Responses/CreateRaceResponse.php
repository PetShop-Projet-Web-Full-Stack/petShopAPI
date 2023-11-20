<?php

namespace App\Responses;

class CreateRaceResponse
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
                'href' => route('races.show', ['id' => $this->items['id']])
            ],
            'species' => [
                'href' => route('species.show', ['id' => $this->items['species_id']])
            ]
        ];
    }
}
