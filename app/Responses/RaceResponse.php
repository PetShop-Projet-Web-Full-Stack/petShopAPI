<?php

namespace App\Responses;

class RaceResponse {
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        $this->items['_links'] = $this->getLinks();
        $this->items['species']['_links'] = $this->getSpeciesLinks();

        return $this->items;
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('races.show', ['id' => $this->items['id']])
            ]
        ];
    }

    private function getSpeciesLinks(): array
    {
        return [
            'self' => [
                'href' => route('species.show', ['id' => $this->items['species_id']])
            ]
        ];
    }
}