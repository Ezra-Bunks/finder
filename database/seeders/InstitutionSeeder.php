<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        Institution::updateOrCreate(
            ['slug' => 'MUK'],
            ['name' => 'Makerere University']
        );

        Institution::updateOrCreate(
            ['slug' => 'MUBS'],
            ['name' => 'Makerere Business School']
        );

        Institution::updateOrCreate(
            ['slug' => 'KU'],
            ['name' => 'Kyambogo University']
        );

        Institution::updateOrCreate(
            ['slug' => 'UCU'],
            ['name' => 'Uganda Christian University']
        );

        Institution::updateOrCreate(
            ['slug' => 'UMU'],
            ['name' => 'Uganda Martyrs University']
        );

        Institution::updateOrCreate(
            ['slug' => 'GU'],
            ['name' => 'Gulu University']
        );
    
        Institution::updateOrCreate(
            ['slug' => 'MUST'],
            ['name' => 'Mbarara University of Science and Technology']
        );
    
        Institution::updateOrCreate(
            ['slug' => 'BUSITEMA'],
            ['name' => 'Busitema University']
        );
    
        Institution::updateOrCreate(
            ['slug' => 'LIRA'],
            ['name' => 'Lira University']
        );
    
        Institution::updateOrCreate(
            ['slug' => 'SOROTI'],
            ['name' => 'Soroti University']
        );
    
        Institution::updateOrCreate(
            ['slug' => 'KABALE'],
            ['name' => 'Kabale University']
        );
    
    }
}
