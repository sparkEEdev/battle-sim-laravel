<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\Game\DTO\ArmyDTO;
use App\Services\Game\AttackService;

class AttackServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_attacker_damage_deducted_from_target_units()
    {
        $attacker = new ArmyDTO(1, 1, 'Army 1', 10, 10, 'weakest', 1);
        $target = new ArmyDTO(2, 1, 'Army 2', 10, 10, 'weakest', 2);

        $attackService = new AttackService();

        $updatedTarget = $attackService->attack($attacker, $target);

        $damage = $attacker->getDamage();

        $this->assertEquals($target->getUnits() - $damage, $updatedTarget->getUnits());
    }

    public function test_target_units_are_zero_upon_overkill()
    {
        $attacker = new ArmyDTO(1, 1, 'Army 1', 10, 10, 'weakest', 1);
        $target = new ArmyDTO(2, 1, 'Army 2', 10, 1, 'weakest', 2);

        $attackService = new AttackService();

        $updatedTarget = $attackService->attack($attacker, $target);

        $this->assertEquals(0, $updatedTarget->getUnits());
    }
}
