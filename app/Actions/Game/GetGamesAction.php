<?php

namespace App\Actions\Game;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Resources\v1\Game\GameCollection;

class GetGamesAction
{
    public function execute(Request $request): GameCollection
    {
        $games = Game::
            with(['armies'])
            ->paginate(
                $request->get('per_page', 10),
                ['*'],
                'page',
                $request->get('page', 1)
            );

        return new GameCollection($games);
    }
}
