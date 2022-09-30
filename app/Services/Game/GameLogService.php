<?php

namespace App\Services\Game;

use App\Models\GameLog;

class GameLogService
{
    public function createLog(int $gameId, string $message): void
    {
        GameLog::create([
            'game_id' => $gameId,
            'message' => $message,
        ]);
    }
}
