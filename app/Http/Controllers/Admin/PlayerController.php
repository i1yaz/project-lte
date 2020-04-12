<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Player;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    // Middleware for Admin
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $players = Player::all();
        return view('admin.player.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'nullable|numeric',

        ]);
        $response = (new TournamentService())->storePlayer($request);
        if ($response) {
            return redirect()->back()->with('success', 'Player has been added!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('admin.player.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'nullable|numeric',

        ]);
        $response = (new TournamentService())->updatePlayer($request, $player);
        if ($response) {
            return redirect()->back()->with('success', 'Player has been updated!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        if ($player->delete()) {
            return redirect()->back()->with('success', 'Player has been deleted!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
}
