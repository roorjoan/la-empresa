<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\ContractType;
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
        User::factory()->create();

        $array_ct = ['Permanent', 'Fixed-Term', 'External'];

        foreach ($array_ct as $ct) {
            ContractType::create([
                'name' => $ct
            ]);
        }

        Employee::factory(2)->create();
        Contract::factory()->create();
    }
}
