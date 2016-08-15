<?php

use Illuminate\Database\Seeder;

class SponsoredLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsored_locations')->truncate();
        factory(App\SponsoredLocation::class)->times(300)->create();
    }
}
