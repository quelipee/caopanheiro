<?php

namespace Database\Seeders;

use App\Models\PetEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shelter;
use App\AdoptPet\enums\AdoptionStatus;

class PetEntrySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = [
            [
                'name' => 'Bella',
                'species' => 'Cachorro',
                'breed' => 'Pastor Alemão',
                'age' => 4,
                'gender' => 'Fêmea',
                'size' => 'Grande',
                'color' => 'Preto e Marrom',
                'description' => 'Leal e protetora, ótima para famílias.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/bella.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Luna',
                'species' => 'Gato',
                'breed' => 'Maine Coon',
                'age' => 2,
                'gender' => 'Fêmea',
                'size' => 'Médio',
                'color' => 'Cinza',
                'description' => 'Calma e carinhosa, adora atenção.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/luna.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Max',
                'species' => 'Cachorro',
                'breed' => 'Labrador Retriever',
                'age' => 3,
                'gender' => 'Macho',
                'size' => 'Grande',
                'color' => 'Amarelo',
                'description' => 'Amigável e enérgico, ótimo com crianças.',
                'status' => AdoptionStatus::ADOPTED,
                'photo' => 'https://example.com/photos/max.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Charlie',
                'species' => 'Cachorro',
                'breed' => 'Beagle',
                'age' => 1,
                'gender' => 'Macho',
                'size' => 'Pequeno',
                'color' => 'Marrom e Branco',
                'description' => 'Brincalhão e curioso, adora explorar.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/charlie.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Milo',
                'species' => 'Gato',
                'breed' => 'Siamês',
                'age' => 5,
                'gender' => 'Macho',
                'size' => 'Pequeno',
                'color' => 'Creme e Marrom',
                'description' => 'Independente e inteligente, muito atento.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/milo.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Sadie',
                'species' => 'Cachorro',
                'breed' => 'Golden Retriever',
                'age' => 6,
                'gender' => 'Fêmea',
                'size' => 'Grande',
                'color' => 'Dourado',
                'description' => 'Gentil e amigável, ótima com crianças.',
                'status' => AdoptionStatus::ADOPTED,
                'photo' => 'https://example.com/photos/sadie.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Simba',
                'species' => 'Gato',
                'breed' => 'Bengal',
                'age' => 3,
                'gender' => 'Macho',
                'size' => 'Médio',
                'color' => 'Marrom Rajado',
                'description' => 'Ativo e brincalhão, adora escalar.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/simba.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Ruby',
                'species' => 'Cachorro',
                'breed' => 'Poodle',
                'age' => 2,
                'gender' => 'Fêmea',
                'size' => 'Médio',
                'color' => 'Branco',
                'description' => 'Muito inteligente e amigável.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/ruby.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Oliver',
                'species' => 'Gato',
                'breed' => 'Persa',
                'age' => 4,
                'gender' => 'Macho',
                'size' => 'Médio',
                'color' => 'Branco',
                'description' => 'Calmo e afetuoso, prefere ambientes tranquilos.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/oliver.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ],
            [
                'name' => 'Daisy',
                'species' => 'Cachorro',
                'breed' => 'Bulldog',
                'age' => 5,
                'gender' => 'Fêmea',
                'size' => 'Médio',
                'color' => 'Tigrado',
                'description' => 'Tranquila e dócil, adora relaxar.',
                'status' => AdoptionStatus::AVAILABLE,
                'photo' => 'https://example.com/photos/daisy.jpg',
                'shelter_id' => Shelter::factory()->create()->id,
            ]
            ];
            foreach ($pets as $pet) {
                PetEntry::create($pet);
            }
    }
}
