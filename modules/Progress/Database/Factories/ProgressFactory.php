<?php

namespace Modules\Progress\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Progress\Models\Progress;

class ProgressFactory extends Factory
{
    protected $model = Progress::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->sentence(4);

        return [
            'name' => $name,            
            
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at' => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
