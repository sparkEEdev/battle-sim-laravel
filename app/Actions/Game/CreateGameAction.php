<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Enums\GameStatusEnum;
use App\Http\Resources\v1\Game\GameResource;

class CreateGameAction
{
    public function execute(): GameResource
    {
        return new GameResource(
            Game::create([
                'status' => GameStatusEnum::PENDING
            ])
        );
    }
}
