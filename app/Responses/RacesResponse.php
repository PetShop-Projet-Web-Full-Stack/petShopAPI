<?php

namespace App\Responses;

class RacesResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        foreach ($this->items as &$item) {
            $item['_links'] = $this->getItemLinks($item);
        }

        $this->items[]['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getItemLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('races.show', ['id' => $item['id']])
            ],
        ];
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('races.index')
            ],
            'create' => [
                'href' => route('races.create')
            ]
        ];
    }
}
