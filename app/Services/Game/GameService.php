<?php

namespace App\Services\Game;

use App\Models\Army;
use App\Models\Game;
use App\Models\GameLog;
use App\Enums\GameStatusEnum;
use App\Enums\AttackStrategyEnum;
use App\Services\Game\ArmyService;
use App\Services\Game\DTO\ArmyDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Game\GameLogService;
use App\Services\Game\Actions\GetAliveArmiesAction;
use App\Services\Game\Exceptions\InvalidAttackStrategyException;

class GameService {

    private int $gameId;

    private int $armyWinnerId;

    private bool $gameOver = false;

    private ArmyService $armyService;

    private GameLogService $gameLogService;

    private AttackService $attackService;

    public function __construct(int $gameId, ArmyService $armyService, AttackService $attackService, GameLogService $gameLogService)
    {
        $this->gameId = $gameId;
        $this->armyService = $armyService;
        $this->attackService = $attackService;
        $this->gameLogService = $gameLogService;
    }

    public function runGame(): void
    {
        // add db transactions

        /* while (!$this->gameOver) {
           //...
        } */

        Game::where('id', $this->gameId)->update([
            'status' => GameStatusEnum::PROCESSING,
            'round_count' => DB::raw('round_count + 1'),
        ]);

        // check reload ?

        // game round started
        $this->runGameRound();

        $data = $this->checkGameOver()
            ? [
                'status' => GameStatusEnum::FINISHED,
                'army_winner_id' => $this->armyWinnerId,
            ]
            : [
                'status' => GameStatusEnum::ACTIVE,
            ];

        Game::where('id', $this->gameId)
            ->update($data);
    }

    private function runGameRound()
    {
        // get potential attackers
        $armies = $this->armyService->getArmies($this->gameId);

        foreach ($armies as $army) {
            // get latest data from database in case one of the attackers died in the meantime
            $latestArmyData = $this->armyService->getArmy($army->getId());

            if ($latestArmyData->isDead()) {
                continue;
            }

            $this->runArmyRound($latestArmyData);

            if ($this->checkGameOver()) {
                break;
            }
        }
    }

    private function runArmyRound(ArmyDTO $army)
    {
        $this->gameLogService->createLog($this->gameId, "Army {$army->getId()} is attempting to attack with {$army->getUnits()}% chance.");

        // Not every attack is successful. Army has 1% of success for every alive unit in it.
        if (!$army->canAttack()) {
            $this->gameLogService->createLog($this->gameId, "Army {$army->getId()} failed to attack.");
            return;
        }

        // Determine the target based on army's attack strategy
        $target = $this->determineStrategyTarget($army);

        // Attack target
        $target = $this->attackService->attack($army, $target);
        $this->gameLogService->createLog($this->gameId, "Army {$army->getId()} attacked army {$target->getId()} and dealt {$army->getDamage()} damage.");

        // Update army units
        $this->armyService->updateArmy($target);
    }

    private function determineStrategyTarget(ArmyDTO $army): ArmyDTO
    {
        switch($army->getAttackStrategy()) {
            case AttackStrategyEnum::RANDOM:
                return $this->armyService->getRandomArmy($this->gameId, $army->getId());
            case AttackStrategyEnum::WEAKEST:
                return $this->armyService->getWeakestArmy($this->gameId, $army->getId());
            case AttackStrategyEnum::STRONGEST:
                return $this->armyService->getStrongestArmy($this->gameId, $army->getId());
            default:
                throw new InvalidAttackStrategyException();
        }
    }

    private function checkGameOver(): bool
    {
        if ($this->gameOver) {
            return true;
        }

        $armies = $this->armyService->getArmies($this->gameId);

        if ( count($armies) == 1 ) {
            $this->gameOver = true;
            $this->armyWinnerId = $armies[0]->getId();

            $this->gameLogService->createLog($this->gameId, "Army {$this->armyWinnerId} won the game.");
        }

        return $this->gameOver;
    }
}
