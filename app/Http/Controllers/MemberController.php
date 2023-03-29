<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{

    protected $fillable = ['name', 'team_id', 'email'];

    /**
     * Display all the teams.
     *
     * @return Response
     */
    public function index()
    {
        $member = Member::latest()->with('team')->paginate(3);

        return response()->json($member, 200);
    }

    /**
     * Display a single member.
     *
     * @return Response
     */
    public function show(Member $member)
    {
        return response()->json($member->with('team'), 200);
    }


    /**
     * Create new member.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        $rules = array(
            'name'     => ['required', ],
            'email'       => ['required','email', Rule::unique('members', 'email')],
            'team_id'     => ['required', Rule::exist('teams', 'id')],
        );

        $formFields = $request->validate($rules);

        $member = Member::create($formFields);

        // Event
        // event(new eventName($member));

        return response()->json($member, 200);

    }
}
