<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Actions\Game\CreateGameAction;
use App\Actions\Game\GetGamesAction;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\v1\Game\GameCollection
     */
    public function index(Request $request, GetGamesAction $getGamesAction)
    {
        return $getGamesAction->execute($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actions\Game\CreateGameAction;
     * @return \App\Http\Resources\v1\Game\GameResource;
     */
    public function store(Request $request, CreateGameAction $createGameAction)
    {
        return $createGameAction->execute();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
