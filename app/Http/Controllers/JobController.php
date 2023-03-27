<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('jobs.index', [
            'jobs' => Job::latest()->filter(request(['tag', 'search']))->paginate(2),
        ]);
    }

    // single job
    public function show(Job $job)
    {
        return view('jobs.job', [
            'job' => $job,
        ]);
    }

    // create job
    public function create()
    {
        return view('jobs.create');
    }

    // store job
    public function store(Request $request)
    {
        // dd(request()->all());
        // validate
        $rules = array(
            'company'     => ['required', Rule::unique('jobs', 'company')],
            'title'       => 'required',
            'email'       => 'required|email',
            'location'    => 'required',
            'website'     => 'required',
            'tags'        => 'required',
            'description' => 'required',

        );

        $formFields = $request->validate($rules);

        if($request->file()) {
            // 'file' => 'required|mimes:jpg,png,jpeg,svg|max:5048'
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Job::create($formFields);

        Session::flash('message', 'Job Successfully created!');
        return Redirect::to('/');
    }
}
