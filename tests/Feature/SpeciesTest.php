<?php

namespace Tests\Feature;

class SpeciesTest extends MainTest
{

    public function testSpeciesReturnNotEmptyArray(): void
    {
        $this->testListNotEmpty('species');
    }

    public function testGetSpeciesById(): void
    {
        $species = $this->createSpecies();
        $this->testGetById('species', $species['id']);
    }

    public function testCreateSpecies(): void
    {
        $this->createSpecies();
    }

    protected function createSpecies()
    {
        $requestData = ['name' => 'Species test'];
        $response = $this->testCreateEntity('species', $requestData, 'species');
        return json_decode($response->getContent(), true);
    }
}
