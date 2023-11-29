<?php

namespace Tests\Feature;

class PetshopTest extends MainTest
{

    public function testPetshopReturnNotEmptyArray(): void
    {
        $this->testListNotEmpty('pet-shops');
    }

    public function testGetPetshopById(): void
    {
        $petshop = $this->createPetshop();
        $this->testGetById('pet-shops', $petshop['id']);
    }

    public function testCreatePetshop(): void
    {
        $this->createPetshop();
    }

    public function testDeletePetShop(): void
    {
        $petshop = $this->createPetshop();
        $this->testDeleteEntity('pet-shops', $petshop);
    }

    protected function createPetshop()
    {
        $petSopData = ["name" => "anmialerie test", "address" => "4 bis rue Mirebeau", "zipcode" => "42350", "city" => "La talaudiere", "phone" => "0787230611", "content" => "Un content", "medias_id" => null];
        $response = $this->testCreateEntity('pet-shops', $petSopData, 'pet_shops');
        return json_decode($response->getContent(), true);
    }
}
