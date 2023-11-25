<?php

namespace App\Responses;

class QuestionsResponse
{
    public function __construct(protected array $items)
    {
    }

    public function toArray(): array
    {
        foreach ($this->items['animals'] as &$item) {
            $item['_links'] = $this->getItemLinks($item);
        }

        $this->items['_links'] = $this->getLinks();

        return $this->items;
    }

    private function getItemLinks(array $item): array
    {
        return [
            'self' => [
                'href' => route('animals.show', ['id' => $item['id']])
            ],
        ];
    }

    private function getLinks(): array
    {
        return [
            'self' => [
                'href' => route('questions.answers')
            ]
        ];
    }
}
