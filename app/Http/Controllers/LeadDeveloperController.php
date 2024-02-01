<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeadDeveloper;
use App\Models\Progress;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class LeadDeveloperController extends Controller
{
    public function loginForm()
    {

        return view('leadDev.login');
    }

    public function login(Request $request)
    {

        $check = $request->all();

        if (Auth::guard('lead_dev')->attempt([

            'email' => $check['email'],
            'password' => $check['password'],
        ])) {

            return redirect()->route('lead_developer.projects.index');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }


    public function logout()
    {

        Auth::guard('lead_dev')->logout();
        return redirect()->route('leadDev.loginForm');
    }


    public function registerForm()
    {


        return view('leadDev.register');
    }

    public function register(Request $request)
    {

        LeadDeveloper::insert([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),


        ]);


        return redirect()->route('leadDev.loginForm');
    }


    public function index()
    {
        //hardcoded
        $leadDev = Auth::guard('lead_dev')->user()->id;;

        $project = Project::where('lead_developer_id', $leadDev)->first();


        if ($project) {

            $progress = Progress::where('project_id', $project->id)->get();
        } else {
            // No project found for the lead developer
            $project = null;
            $progress = null;
        }

        return view('leadDev.projects.index', compact('progress', 'project'));
    }


    public function show(Project $project)
    {
        return view('leadDev.projects.project', compact('project'));
    }

    public function createProgressForm(Project $project)
    {
        return view('leadDev.projects.create_progress', compact('project'));
    }

    public function storeProgress(Request $request, Project $project)
    {
        $request->validate([
            'progress_id' => 'required|numeric',
            'status' => 'required',
            'date' => 'required|date',
            'description' => 'required',
        ]);

        // Create and store the project progress
        $progress = new Progress([
            'progress_id' => $request->input('progress_id'),
            'status' => $request->input('status'),
            'date' => $request->input('date'),
            'description' => $request->input('description'),
        ]);

        $project->progress()->save($progress);

        return redirect()->route('lead_developer.projects.index')->with('success', 'Project progress added successfully');
    }
}
