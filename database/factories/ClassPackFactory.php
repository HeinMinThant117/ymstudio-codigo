<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassPackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'disp_order' => $this->faker->randomDigit(),
            'pack_id' => Str::uuid(),
            'pack_name' => $this->faker->streetName,
            'pack_description' => $this->faker->sentence(),
            'pack_type' => $this->faker->randomElement(['unlimited', 'non_shareable']),
            'total_credit' => $this->faker->randomDigit(),
            'tag_name' => $this->faker->randomElement([null, 'New', 'Popular', 'Limited']),
            'validity_month' => $this->faker->randomDigit(),
            'pack_price' => $this->faker->randomDigit(),
            'newbie_first_attend' => $this->faker->randomElement([true, false]),
            'newbie_addition_credit' => $this->faker->randomDigit(),
            'newbie_note' => $this->faker->sentence(),
            'pack_alias' => $this->faker->word(),
            'estimate_price' => $this->faker->randomDigit()
        ];
    }
}
