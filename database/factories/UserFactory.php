<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'id' => '@' . fake()->userName(),
            'name' => fake()->name(),
            'desc' => fake()->sentence(),
            'pp' => fake()->imageUrl(100, 100, 'people'),
            'pass' => bcrypt('password'),
            'perm_level' => fake()->numberBetween(0, 10),
            'icetoken' => Str::random(32),
            'is_listening' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
