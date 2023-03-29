<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    /**
     * Display all the teams.
     *
     * @return Response
     */
    public function index()
    {
        $teams = Team::latest()->with('members')->paginate(3);

        return response()->json($teams, 200);
    }

    /**
     * Display a single team.
     *
     * @return Response
     */
    public function show(Team $team)
    {
        return response()->json($team->with('members'), 200);
    }

    /**
     * Soft Delete on teams.
     *
     * @return Response
     */
    public function destroy(Team $team)
    {

        $team->delete();

        return response()->json('Team deleted', 200);
    }
}
