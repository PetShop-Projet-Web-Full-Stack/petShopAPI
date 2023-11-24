<?php

namespace Tests\Feature;

class RacesTest extends MainTest
{

    public function testRacesReturnNotEmptyArray(): void
    {
        $this->testListNotEmpty('races');
    }

    public function testGetRaceById(): void
    {
        $species = $this->createSpecies();
        $race = $this->createRace($species);
        $this->testGetById('races', $race['id']);
    }

    public function testCreateRaces(): void
    {
        $species = $this->createSpecies();
        $this->createRace($species);
    }

    protected function createSpecies()
    {
        $species = ['name' => 'Species test'];
        $response = $this->testCreateEntity('species', $species, 'species');
        return json_decode($response->getContent(), true);
    }

    protected function createRace($species)
    {
        $race = ['name' => 'Race test', 'species_id' => strval($species['id'])];
        $response = $this->testCreateEntity('races', $race, 'races');
        return json_decode($response->getContent(), true);
    }
}
