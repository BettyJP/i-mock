<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Auth\Clients;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clients::factory()->create([
            'client_id' => '098aydsaashjdilnbgib',
            'client_secret' => 'akljsdbn9o8as6d907623h5oihda9f',
            'token' => (string) Str::uuid(),
            'expire' => '2024-07-13 17:00:00',
        ]);
    }
}
