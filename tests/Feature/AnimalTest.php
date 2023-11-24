<?php

namespace Tests\Feature;

use Carbon\Carbon;

class AnimalTest extends MainTest
{


    public function testAnimalsReturnNotEmptyArray(): void
    {
        $this->testListNotEmpty('animals');
    }

    public function testGetAnimalById(): void
    {
        $animal = $this->createAnimals();
        $this->testGetById('animals', $animal['id']);
    }

    public function testCreateAnimals(): void
    {
        $this->createAnimals();
    }

    protected function createSpecies()
    {
        $species = ['name' => 'Species test'];
        $response = $this->testCreateEntity('species', $species, 'species');
        return json_decode($response->getContent(), true);
    }

    protected function createRaces($speciesData)
    {
        $races = ['name' => 'Race test', "species_id" => strval($speciesData['id'])];
        $raceCreated = $this->testCreateEntity('races', $races, 'races');
        return  json_decode($raceCreated->getContent(), true);
    }

    protected function createPetShop()
    {
        $petshop = ["name" => "anmialerie test", "address" => "4 bis rue Mirebeau", "zipcode" => "42350", "city" => "La talaudiere", "phone" => "0787230611", "content" => "Un content", "medias_id" => null];
        $petshopCreated  = $this->testCreateEntity('pet-shops', $petshop, 'pet_shops');
        return json_decode($petshopCreated->getContent(), true);
    }

    protected function createAnimals()
    {
        $speciesData = $this->createSpecies();
        $raceData = $this->createRaces($speciesData);
        $petshopData = $this->createPetShop();
        $animal = ["name" => "animal test", "gender" => "Male", "date_of_birth" => Carbon::now()->toDateString(), "race_id" => strval($raceData['id']), "pet_shop_id" => strval($petshopData['id']), "media_id" => null];
        $response = $this->testCreateEntity('animals', $animal, 'animals');
        return json_decode($response->getContent(), true);
    }
}
