<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        'first_name',
//        'last_name',
//        'phone',
//        'email',
//        'address',
//        'role',
//        'grade_id',
//        'staff_id',
//        'manager_id',
//        'hiredate',
//        'gender',
//        'dob',
//        'last_login',
//        'last_login_ip',
        $roles=['employee','manager','admin'];
        $grade=Grade::inRandomOrder()->first();
        $manager=User::where('role','manager')->inRandomOrder()->first();
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address'=>fake()->address(),
            'role'=>fake()->randomElement(Role::class),
            'grade_id'=>$grade->id,
            'status'=>1,
            'staff_id'=>fake()->numerify('id-#####'),
            'manager_id'=>$manager?$manager->id:1,
            'hiredate'=>fake()->dateTimeBetween('-5 years','now',)->format('Y-m-d'),
            'dob'=>fake()->dateTimeBetween('-30 years','-20 years')->format('Y-m-d'),
            'gender'=>fake()->randomElement(Gender::class),
            'last_login'=>fake()->dateTimeBetween('-3 months','now')->format('Y-m-d H:i:s'),
            'last_login_ip'=>fake()->ipv4(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
