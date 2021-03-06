<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MasterSuratTableSeeder::class);
        $this->call(MasterAgamaTableSeeder::class);
        $this->call(MasterPenggunaTableSeeder::class);
        $this->call(ProfilPerangkatTableSeeder::class);
        $this->call(MasterPendidikanTableSeeder::class);
        $this->call(MasterJenisKelaminTableSeeder::class);
        $this->call(ProfilPemerintahanTableSeeder::class);
        $this->call(KependudukanPendudukTableSeeder::class);
        $this->call(MasterStatusPerkawinanTableSeeder::class);
    }
}
