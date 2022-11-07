<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;

class UserSeeder extends Seeder
{
    private UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run()
    {
        User::factory(10)->create();

        $this->service->store([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
