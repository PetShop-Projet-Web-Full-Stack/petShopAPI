<?php

namespace App\Responses;

class AnimalsUserResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        foreach ($this->items as &$item) {
            $item['animal']['_links'] = $this->getAnimalItemLinks($item);
        }

        $this->items[]['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('animals-user.index')
            ],
            'create' => [
                'href' => route('animals-user.create')
            ]
        ];
    }

    private function getAnimalItemLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $item['animal_id']])
            ],
        ];
    }
}
