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

        $formFields['user_id'] = auth()->id();

        Job::create($formFields);

        Session::flash('message', 'Job Successfully created!');
        return Redirect::to('/');
    }

    // edit job
    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job,
        ]);
    }

    // update job
    public function update(Request $request, Job $job)
    {
        if ($job->user_id !== auth()->id()) {
           abort(403, 'UnAuthorized Action');
        }

        // validate
        $rules = array(
            'company'     => 'required',
            'title'       => 'required',
            'email'       => 'required|email',
            'location'    => 'required',
            'website'     => 'required',
            'tags'        => 'required',
            'description' => 'required',
        );

        $formFields = $request->validate($rules);

        if($request->file()) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $job->update($formFields);

        Session::flash('message', 'Job Successfully updated!');
        return Redirect::to('/jobs/'.$job->id);
    }

     // delete job
     public function delete(Job $job)
     {
        $job->delete();

        Session::flash('message', 'Job Successfully Deleted!');
        return Redirect::to('/');
     }

     // manage job
     public function manage()
     {
        return view('jobs.manage', [
            'jobs' => Job::where('user_id', auth()->id())->get(),
        ]);
     }
}
