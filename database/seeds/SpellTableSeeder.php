<?php

use Illuminate\Database\Seeder;

class SpellTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Spell::class, 50)->create();
    }
}
