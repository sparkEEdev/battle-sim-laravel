<?php

namespace App\Actions\Game;
use App\Models\Game;
use App\Enums\GameStatusEnum;
use App\Services\Game\ArmyService;
use App\Services\Game\GameService;
use App\Services\Game\AttackService;
use App\Services\Game\GameLogService;
use App\Http\Resources\v1\Game\GameResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class RunAttackGameAction
{
    private ArmyService $armyService;

    private GameLogService $gameLogService;

    private AttackService $attackService;

    public function __construct(ArmyService $armyService, GameLogService $gameLogService, AttackService $attackService)
    {
        $this->armyService = $armyService;
        $this->gameLogService = $gameLogService;
        $this->attackService = $attackService;
    }

    public function execute(int $gameId): JsonResponse
    {
        $game = Game::withCount('armies')->find($gameId);

        if ( $game->status == GameStatusEnum::PENDING && $game->armies_count < 5 ) {
            return response()->json([
                'message' => 'Cannot run attack, add more armies to the game',
            ], 400);
        }

        // or extract into job and queue it instead?
        $gameService = new GameService(
            $gameId,
            $this->armyService,
            $this->attackService,
            $this->gameLogService,
        );

        $gameService->runGame();

        $gameData = Game::with('winner')
            ->withCount(['armies', 'remaining_armies'])
            ->find($gameId);

        return response()->json([
            'message' => 'Attack executed succesfully.',
            'data' => new GameResource($gameData),
        ], 200);
    }
}
