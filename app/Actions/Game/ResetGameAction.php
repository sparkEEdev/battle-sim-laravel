<?php

namespace App\Actions\Game;
use App\Models\Army;
use App\Models\Game;
use App\Models\GameLog;
use App\Enums\GameStatusEnum;
use App\Services\Game\GameService;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResetGameAction
{
    public function execute(int $gameId): JsonResponse
    {
        $game = Game::where('status', GameStatusEnum::ACTIVE)->find($gameId);

        if (!$game) {
            return response()->json([
                'message' => 'Cannot reset game, game is not active',
            ], 400);
        }

        Game::where('id', $gameId)->update([
            'status' => GameStatusEnum::PENDING,
            'round_count' => 0,
            'army_winner_id' => null,
        ]);

        Army::where('game_id', $gameId)->update([
            'units' => DB::raw('initial_units'),
        ]);

        GameLog::where('game_id', $gameId)->delete();

        return response()->json([
            'message' => 'Game reset!',
        ], 200);
    }
}
