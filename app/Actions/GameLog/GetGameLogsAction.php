<?php

namespace App\Actions\GameLog;

use App\Models\GameLog;
use Illuminate\Http\Request;
use App\Http\Resources\v1\GameLog\GameLogCollection;

class GetGameLogsAction
{
    public function execute(Request $request): GameLogCollection
    {
        $games = GameLog::
            when($request->get('game_id', false), function ($query) use ($request) {
                return $query->where('game_id', $request->get('game_id'));
            })
            ->orderBy($request->get('sort_by', 'created_at'), $request->get('sort_direction', 'desc'))
            ->paginate(
                $request->get('per_page', 10),
                ['*'],
                'page',
                $request->get('page', 1)
            );

        return new GameLogCollection($games);
    }
}
