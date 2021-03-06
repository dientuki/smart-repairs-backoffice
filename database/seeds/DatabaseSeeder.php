<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

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
        $this->call([
            UsersTableSeeder::class,
            LoginsTableSeeder::class,
            RolesTableSeeder::Class,
            AccountsTableSeeder::Class,
            MembershipsTableSeeder::Class,
            BrandsTableSeeder::Class,
            DeviceTypeTableSeeder::Class,
            DevicesTableSeeder::Class,
            PartsTableSeeder::Class
        ]);
    }
}
