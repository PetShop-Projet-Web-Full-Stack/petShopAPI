<?php

namespace App\Responses;

class UserResponse {
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
                'type' => request()->getMethod(),
                'href' => url('/') . request()->getRequestUri(),
            ],
            'logout' => [
                'type' => 'POST',
                'href' => url('/') . '/api/logout',
            ],
            'delete' => [
                'type' => 'DELETE',
                'body' => [
                    'id' => auth()->user()->id,
                ],
                'href' => url('/') . '/api/user/delete',
            ],
            'user-data' => [
                'type' => 'GET',
                'href' => url('/') . '/api/user',
            ],
            'update-profile' => [
                'type' => 'PUT',
                'body' => [
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'href' => url('/') . '/api/user/update-profile',
            ],
            'update-password' => [
                'type' => 'PUT',
                'body' => [
                    'current_password' => 'your_current_password',
                    'password' => 'your_new_password',
                    'password_confirmation' => 'your_new_password_confirmation',
                ],
                'href' => url('/') . '/api/user/update-password',
            ],
            'confirm-password' => [
                'type' => 'POST',
                'body' => [
                    'password' => 'your_password',
                ],
                'href' => url('/') . '/api/user/confirm-password',
            ],
            'confirm-password-status' => [
                'type' => 'GET',
                'href' => url('/') . '/api/user/confirm-password-status',
            ],
        ];
    }
}
