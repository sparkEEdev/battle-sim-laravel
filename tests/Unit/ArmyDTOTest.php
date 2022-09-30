<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Game\DTO\ArmyDTO;

class ArmyDTOTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_army_damage_is_half_of_each_unit_point()
    {
        $army = new ArmyDTO(1, 1, 'Army 1', 10, 10, 'weakest', 1);

        $this->assertEquals(5, $army->getDamage());
    }

    public function test_army_damage_is_one_if_there_is_one_unit_left()
    {
        $army = new ArmyDTO(1, 1, 'Army 1', 10, 1, 'weakest', 1);

        $this->assertEquals(1, $army->getDamage());
    }

    public function test_army_damage_is_zero_if_there_is_no_units_left()
    {
        $army = new ArmyDTO(1, 1, 'Army 1', 10, 0, 'weakest', 1);

        $this->assertEquals(0, $army->getDamage());
    }
}
