<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('accounts')->truncate();
    //     DB::table('accounts')->insert([
    //         'name' => 'Test',
    //         'email' => 'test@account.com',
    //         'password' => bcrypt('1234567'),
    //     ]);
    // }

    public function run(Faker $faker)
    {
        factory(App\Account::class,5)->create();
    }
}
