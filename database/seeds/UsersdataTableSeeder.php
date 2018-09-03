<?php
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_stand  = Role::where('name', 'stand')->first();

         $employee = new User();
         $employee->name = 'Cristobal Donoso';
         $employee->email = 'cridonoso@udec.cl';
         $employee->password = bcrypt('1234');
         $employee->save();
         $employee->roles()->attach($role_admin);

         $manager = new User();
         $manager->name = 'Cesar Gonzalez';
         $manager->email = 'cesar@udec.cl';
         $manager->password = bcrypt('1234');
         $manager->save();
         $manager->roles()->attach($role_stand);

    }
}
