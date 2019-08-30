<?php

use App\Specialty;

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Specialty::create([
            'name'=>'Oftafmologia',
            'description'=>'Es la especialidad médica que estudia las enfermedades de ojo y su tratamiento.'
        ]);
        Specialty::create([
            'name'=>'Neurología',
            'description'=>'Es la especialidad médica que trata los trastornos del sistema nervioso. 🧠'
        ]);
        Specialty::create([
            'name'=>'Pediatría',
            'description'=>'Parte de la medicina que se ocupa del estudio del crecimiento y el desarrollo de los niños hasta la adolescencia'
        ]);
    }
}
