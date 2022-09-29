<?php

namespace App\Actions\Army;

use Exception;
use App\Models\Army;
use App\Models\Game;
use App\Enums\GameStatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Requests\v1\CreateArmyRequest;
use App\Http\Resources\v1\Army\ArmyResource;

class CreateArmyAction
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Game\CreateGameAction;
     * @return \Illuminate\Http\JsonResponse|\App\Http\Resources\v1\Army\ArmyResource
     */
    public function execute(CreateArmyRequest $request)
    {
        $data = $request->validated();

        $game = Game::find($data['game_id']);

        if ($game->status == GameStatusEnum::FINISHED || $game->status == GameStatusEnum::PROCESSING) {
            // TODO: extract into request validator
            return response()->json([
                'message' => "Cannot add armeies, game is {$game->status}",
            ], 400);
        }

        try {

            if ($game->status == GameStatusEnum::ACTIVE) {
                Army::where('game_id', $data['game_id'])->increment('ordinal');
                $data['ordinal'] = 1;
            } else {
                $data['ordinal'] = Army::where('game_id', $data['game_id'])->count() + 1;
            }

            $army = Army::create($data);

            return new ArmyResource($army);

        } catch (QueryException $e) {

            if ($e->errorInfo[1] == 1062) {
                // TODO: extract into request validator
                // constraint violation (duplicate entry) - unique pair of game_id and name
                return response()->json(['message' => 'The army name is already used in selected game.'], 400);
            }
            Log::info($e);
            return response()->json(['message' => 'Failed to create army.'], 400);
        } catch (Exception $e) {
            Log::info($e);
            return response()->json(['message' => 'Something went wrong.'], 400);
        }

    }
}
