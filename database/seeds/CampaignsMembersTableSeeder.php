<?php

use Illuminate\Database\Seeder;

class CampaignsMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('campaigns_members')->insert([
          'member_id' => 1,
          'campaign_id' => 1
      ]);
    }
}
