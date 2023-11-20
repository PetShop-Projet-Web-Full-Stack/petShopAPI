<?php

namespace App\Responses;

class CreateAnimalsUserResponse
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
            'animal' => [
                'href' => route('animals.show', ['id' => $this->items['animal_id']])
            ],
        ];
    }
}
