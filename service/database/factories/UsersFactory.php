<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->passthrough('123456789'),
            'phone' => $this->faker->phoneNumber,
            'refferal_code' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,6),
            'address' => $this->faker->address,
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
