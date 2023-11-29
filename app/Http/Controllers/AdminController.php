<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\PetShop;
use App\Models\Race;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    protected $animalFields = [
        ['name' => 'name', 'type' => 'varchar', 'label' => 'Name'],
        ['name' => 'gender', 'type' => 'enum', 'label' => 'Gender', 'options' => ['Male', 'Female']],
        ['name' => 'date_of_birth', 'type' => 'date', 'label' => 'Date of Birth'],
        ['name' => 'activity_level', 'type' => 'enum', 'label' => 'Activity Level', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'living_space', 'type' => 'enum', 'label' => 'Living Space', 'options' => ['Appartement', 'Maison']],
        ['name' => 'size', 'type' => 'enum', 'label' => 'Size', 'options' => ['Petit', 'Medium', 'Large']],
        ['name' => 'socialization', 'type' => 'enum', 'label' => 'Socialization', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'grooming_needs', 'type' => 'enum', 'label' => 'Grooming Needs', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'noise_level', 'type' => 'enum', 'label' => 'Noise Level', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'trainability', 'type' => 'enum', 'label' => 'Trainability', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'outdoor_activity', 'type' => 'enum', 'label' => 'Outdoor Activity', 'options' => ['Haut', 'Medium', 'Bas']],
        ['name' => 'family_friendly', 'type' => 'tinyint', 'label' => 'Family Friendly'],
        ['name' => 'status', 'type' => 'tinyint', 'label' => 'Status'],
    ];

    protected $petshopFields = [
        ['name' => 'name', 'type' => 'varchar', 'label' => 'Name'],
        ['name' => 'address', 'type' => 'varchar', 'label' => 'Adresse'],
        ['name' => 'zipcode', 'type' => 'varchar', 'label' => 'Code postal'],
        ['name' => 'city', 'type' => 'varchar', 'label' => 'Ville'],
        ['name' => 'phone', 'type' => 'varchar', 'label' => 'Numéro de téléphone'],
        ['name' => 'content', 'type' => 'varchar', 'label' => 'Description'],
    ];

    public function index()
    {
        $animals = Animal::all();
        $petshops = PetShop::all();
        return view('admin.admin', ['animals' => $animals, 'petshops' => $petshops]);
    }

    public function editAnimal($id)
    {
        $animal = Animal::find($id);
        if (!$animal) {
            abort(404);
        }
        return view('admin.animal.editAnimal', ['animal' => $animal, 'fields' => $this->animalFields]);
    }

    public function editPetShop($id)
    {
        $petShop = PetShop::find($id);
        if (!$petShop) {
            abort(404);
        }
        return view('admin.pet-shop.editPetShop', ['petShop' => $petShop, 'fields' => $this->petshopFields]);
    }

    public function updateAnimal(Request $request, $id)
    {
        $validationRules = [];

        foreach ($this->animalFields as $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $validationRules[$fieldName] = $this->mapValidationRule($fieldType, $field);
        }

        $validationRules['family_friendly'] = 'nullable|boolean';
        $validationRules['status'] = 'nullable|boolean';

        $validatedData = $request->validate($validationRules);
        $animal = Animal::find($id);

        if (!$animal) {
            return redirect()->route('admin.index')->with('error', 'Animal not found');
        }

        foreach ($validatedData as $field => $value) {
            $animal->{$field} = $value;
        }

        $animal->save();

        return redirect()->route('admin.index')->with('success', 'Animal updated successfully');
    }

    public function updatePetShop(Request $request, $id)
    {
        $validationRules = [];
        foreach ($this->petshopFields as $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $validationRules[$fieldName] = $this->mapValidationRule($fieldType, $field);
        }

        $validatedData = $request->validate($validationRules);
        $petShop = PetShop::find($id);

        if (!$petShop) {
            return redirect()->route('admin.index')->with('error', 'PetShop not found');
        }

        foreach ($validatedData as $field => $value) {
            $petShop->{$field} = $value;
        }

        $petShop->save();
        return redirect()->route('admin.index')->with('success', 'PetShop updated successfully');
    }

    private function mapValidationRule($fieldType, $field)
    {
        switch ($fieldType) {
            case 'varchar':
                return 'required|string|max:255';
            case 'enum':
                return 'required|string|in:' . implode(',', $field['options']);
            case 'date':
                return 'required|date';
            case 'tinyint':
                return 'required|boolean';
            default:
                return 'required';
        }
    }

    public function deleteAnimal($id)
    {
        $animal = Animal::find($id);
        if (!$animal) {
            return redirect()->route('admin.index')->with('error', 'Animal not found');
        }
        $animal->forceDelete();
        return redirect()->route('admin.index')->with('success', 'Animal deleted successfully');
    }

    public function deletePetShop($id)
    {
        $petshop = PetShop::find($id);
        if (!$petshop) {
            return redirect()->route('admin.index')->with('error', 'Petshop not found');
        }
        $petshop->forceDelete();
        return redirect()->route('admin.index')->with('success', 'Petshop deleted successfully');
    }

    public function addAnimal()
    {
        $races = Race::all();
        $petShops = PetShop::all();
        return view('admin.animal.addAnimal', ['fields' => $this->animalFields, 'races' => $races, 'petShops' => $petShops]);
    }

    public function addPetShop()
    {
        return view('admin.pet-shop.addPetShop', ['fields' => $this->petshopFields]);
    }

    public function createAnimal(Request $request)
    {

        $validationRules = [];
        foreach ($this->animalFields as $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $validationRules[$fieldName] = $this->mapValidationRule($fieldType, $field);
        }

        $validationRules['family_friendly'] = 'nullable|boolean';
        $validationRules['status'] = 'nullable|boolean';

        $validatedData = $request->validate($validationRules);

        $animal = new Animal();

        foreach ($validatedData as $field => $value) {
            $animal->{$field} = $value;
        }

        $raceId = $request->input('race');
        $petshopId = $request->input('petshop');
        $animal->pet_shop_id = $petshopId;
        $animal->race_id = $raceId;
        $animal->save();

        return redirect()->route('admin.index')->with('success', 'Animal added successfully');
    }

    public function createPetShop(Request $request)
    {
        $validationRules = [];
        foreach ($this->petshopFields as $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $validationRules[$fieldName] = $this->mapValidationRule($fieldType, $field);
        }

        $validatedData = $request->validate($validationRules);
        $petshop = new PetShop();

        if (!$petshop) {
            return redirect()->route('admin.index')->with('error', 'PetShop not found');
        }

        foreach ($validatedData as $field => $value) {
            $petshop->{$field} = $value;
        }

        $petshop->save();
        return redirect()->route('admin.index')->with('success', 'PetShop updated successfully');
    }
}
