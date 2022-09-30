<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\GameLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\GameLog\GetGameLogsAction;
use App\Http\Resources\v1\GameLog\GameLogCollection;

class GameLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GameLogCollection
     */
    public function index(Request $request, GetGameLogsAction $getGameLogsAction)
    {
        return $getGameLogsAction->execute($request);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GameLog  $gameLog
     * @return \Illuminate\Http\Response
     */
    public function show(GameLog $gameLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GameLog  $gameLog
     * @return \Illuminate\Http\Response
     */
    public function edit(GameLog $gameLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GameLog  $gameLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GameLog $gameLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameLog  $gameLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameLog $gameLog)
    {
        //
    }
}
