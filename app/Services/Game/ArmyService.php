<?php

namespace App\Services\Game;

use App\Models\Army;
use App\Services\Game\DTO\ArmyDTO;

class ArmyService
{
    /**
     * @return ArmyDTO[]
     */
    public function getArmies(int $gameId, ?int $excludeId = null): array
    {
        $data = Army::where('game_id', $gameId)
            ->when($excludeId, function ($query) use ($excludeId) {
                $query->where('id', '!=', $excludeId);
            })
            ->where('units', '>', 0) // where army is not dead
            ->orderBy('ordinal', 'asc')
            ->get()->toArray();

        $armies = [];

        foreach ($data as $army) {
            $armies[] = ArmyDTO::fromArray($army);
        }

        return $armies;
    }

    public function getArmy(int $armyId): ArmyDTO
    {
        $army = Army::findOrFail($armyId);

        return ArmyDTO::fromArray($army->toArray());
    }

    public function updateArmy(ArmyDTO $army): void
    {
        Army::where('id', $army->getId())
            ->update([
                'units' => $army->getUnits(),
            ]);
    }

    public function getRandomArmy(int $gameId, int $armyId): ArmyDTO
    {
        /* $armies = $this->getArmies($armyId);

        $randomArmy = $armies[array_rand($armies)];

        return $randomArmy; */

        $randomArmy = Army::where('game_id', $gameId)
            ->where('id', '!=', $armyId)
            ->where('units', '>', 0)
            ->inRandomOrder()
            ->first();

        return ArmyDTO::fromArray($randomArmy->toArray());
    }

    public function getWeakestArmy(int $gameId, int $armyId): ArmyDTO
    {
        /* $armies = $this->getArmies($armyId);

        $weakestArmy = $armies[0];

        foreach ($armies as $army) {
            if ( $army->getUnits() < $weakestArmy->getUnits() ) {
                $weakestArmy = $army;
            }
        }

        return $weakestArmy; */

        $weakestArmy = Army::where('game_id', $gameId)
            ->where('id', '!=', $armyId)
            ->where('units', '>', 0)
            ->orderBy('units', 'asc')
            ->orderBy('ordinal', 'asc')
            ->first();

        return ArmyDTO::fromArray($weakestArmy->toArray());
    }

    public function getStrongestArmy(int $gameId, int $armyId): ArmyDTO
    {
        /* $armies = $this->getArmies($armyId);

        $strongestArmy = $armies[0];

        foreach ($armies as $army) {
            if ( $army->getUnits() > $strongestArmy->getUnits() ) {
                $strongestArmy = $army;
            }
        }

        return $strongestArmy; */

        $strongestArmy = Army::where('game_id', $gameId)
            ->where('id', '!=', $armyId)
            ->orderBy('units', 'desc')
            ->orderBy('ordinal', 'asc')
            ->first();

        return ArmyDTO::fromArray($strongestArmy->toArray());
    }
}
