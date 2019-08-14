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
        factory(User::class, 50)->create();
    }
}
