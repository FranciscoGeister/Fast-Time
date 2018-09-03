<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $role = new App\Role();
       $role->name = 'Administrador Master';
       $role->save();

       $role = new App\Role();
       $role->name = 'Administrador Contratado';
       $role->save();

       $role = new App\Role();
       $role->name = 'Asistente';
       $role->save();

       $role = new App\Role();
       $role->name = 'Entrenador';
       $role->save();

       $role = new App\Role();
       $role->name = 'Gerente Técnico';
       $role->save();

       $role = new App\Role();
       $role->name = 'Nutricionista';
       $role->save();
     }
}
