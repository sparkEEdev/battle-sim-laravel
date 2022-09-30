<?php

namespace App\Services\Game;

use App\Services\Game\DTO\ArmyDTO;

class AttackService
{
    public function attack(ArmyDTO $attacker, ArmyDTO $target): ArmyDTO
    {
        $targetUnits = $target->getUnits() - $attacker->getDamage();

        $targetUnits = $targetUnits >= 0
            ? $targetUnits
            : 0;

        return $target->fromUnits($targetUnits);
    }
}

