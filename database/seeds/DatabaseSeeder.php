<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
      // // User seeder will use the roles above created.
      //   $this->call(UserTableSeeder::class);
      //   $this->call(MembersTableSeeder::class);
        // $this->call(PathologiesTableSeeder::class);
        // $this->call(PreguntasMedicasTableSeeder::class);
      //   $this->call(ProfesionalsTableSeeder::class);
      //   $this->call(CampaignsTableSeeder::class);
      //   $this->call(CampaignsMembersTableSeeder::class);
      //   $this->call(AchievementsTableSeeder::class);
      //   $this->call(AntecedentesTableSeeder::class);
      // $this->call(PreguntasHabitosTableSeeder::class);
    }
}
