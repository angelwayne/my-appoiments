<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

use App\User;

$factory->define(App\Appointment::class, function (Faker $faker) {

    $doctorIds = User::doctors()->pluck('id');
    $patientIds = User::patients()->pluck('id');

    $scheduled= $faker->dateTimeBetween('- 1 years','now');
    $schedule_date= $scheduled->format('Y-m-d');
    $schedule_time= $scheduled->format('H:i:s');

    $types = ['Consulta','Analisis Clinicos','Cirugia'];
    $status = ['Atendida' , 'Cancelada']; //'Reservada', 'Confirmada',

    return [
        //
        'description'=> $faker->sentence(5),
        'specialty_id'=> $faker->numberBetween(1, 3),
        'doctor_id'=> $faker->randomElement($doctorIds),
        'patient_id'=> $faker->randomElement($patientIds),
        'schedule_date'=>  $schedule_date,
        'schedule_time'=> $schedule_time,
        'type'=> $faker->randomElement($types),
        'status'=> $faker->randomElement($status)

    ];
});
