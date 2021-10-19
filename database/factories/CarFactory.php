<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->title(),
            'type'=>$this->faker->title(),
            'chassis_number'=>Str::random(6),
            'model_id'=>CarModel::all(['id'])->random(),
            'client_id'=>Client::all(['id'])->random()
        ];
    }
}
