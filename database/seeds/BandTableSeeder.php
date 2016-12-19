<?php

use Illuminate\Database\Seeder;

class BandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Band\Band::class, 15)->create()->each(function ($u) {  
            $u->albums()->save(factory(App\Models\Band\Album::class)->make());
            $u->albums()->save(factory(App\Models\Band\Album::class)->make());
            $u->albums()->save(factory(App\Models\Band\Album::class)->make());
        });
    }
}
