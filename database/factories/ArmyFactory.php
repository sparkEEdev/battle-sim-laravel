<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\AttackStrategyEnum;

class ArmyFactory extends Factory
{

    private $gameOrdinals = [];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gameId = $this->faker->numberBetween(1, 5);

        if ( ! isset($this->gameOrdinals[$gameId])) {
            $this->gameOrdinals[$gameId] = 1;
        } else {
            $this->gameOrdinals[$gameId]++;
        }

        return [
            'name' => $this->faker->name,
            'game_id' => $gameId,
            'initial_units' => $this->faker->numberBetween(80, 100),
            'attack_strategy' => $this->faker->randomElement(AttackStrategyEnum::getValues()),
            'ordinal' => $this->gameOrdinals[$gameId],
        ];
    }
}
