<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Angel Gonzalez Wayne',
            'email' => 'administrador@nextpageti.com',
            'password' => bcrypt('myapp123'), // password
            'cedula'=>'8634300',
            'address'=> 'New Asgard',
            'phone'=> '7221182870',
            'role'=> 'admin'
            ]);

            User::create([
                'name' => 'Laura Antonio',
                'email' => 'laura@nextpageti.com',
                'password' => bcrypt('iJHkHb'), // password
                'cedula'=>'8634301',
                'address'=> 'New Asgard',
                'phone'=> '7221182870',
                'role'=> 'patinet'
                ]);

             User::create([
            'name' => 'Angel Gonzalez Zepeda',
            'email' => 'agonzalez@nextpageti.com',
            'password' => bcrypt('123123'), // password
            'cedula'=>'8634302',
            'address'=> 'New Asgard',
            'phone'=> '7221182870',
            'role'=> 'doctor'
            ]);

        factory(User::class, 50)->states('patient')->create();
    }
}
