<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Army;
use App\Models\Game;
use App\Services\Game\ArmyService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArmyServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_weakest_army_returns_army_with_lowest_ordinal()
    {
        // The weakest army is the one with the lowest number of units.
        // If there is a tie, the weakest army is the one with the lowest ordinal.

        Game::factory()->create();
        Army::factory([
            'id' => 1,
            'game_id' => 1,
            'initial_units' => 5,
            'attack_strategy' => 'weakest',
            'ordinal' => 3,
        ])->create();
        Army::factory([
            'id' => 2,
            'game_id' => 1,
            'initial_units' => 5,
            'attack_strategy' => 'weakest',
            'ordinal' => 2,
        ])->create();


        $armyService = new ArmyService();
        $weakestArmy = $armyService->getWeakestArmy(1, 9999);


        $this->assertEquals(2, $weakestArmy->getOrdinal());
        $this->assertEquals(2, $weakestArmy->getId());
    }

    public function test_get_strongest_army_returns_army_with_lowest_ordinal()
    {
        // The strongest army is the one with the highest number of units.
        // If there is a tie, the strongest army is the one with the lowest ordinal.

        Game::factory()->create();
        Army::factory([
            'id' => 1,
            'game_id' => 1,
            'initial_units' => 5,
            'attack_strategy' => 'strongest',
            'ordinal' => 3,
        ])->create();
        Army::factory([
            'id' => 2,
            'game_id' => 1,
            'initial_units' => 5,
            'attack_strategy' => 'strongest',
            'ordinal' => 2,
        ])->create();


        $armyService = new ArmyService();
        $weakestArmy = $armyService->getStrongestArmy(1, 9999);


        $this->assertEquals(2, $weakestArmy->getOrdinal());
        $this->assertEquals(2, $weakestArmy->getId());
    }
}
