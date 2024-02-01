<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class OwnerController extends Controller
{

    public function loginForm()
    {

        return view('owner.login');
    }

    public function login(Request $request)
    {

        $check = $request->all();

        if (Auth::guard('owner')->attempt([

            'email' => $check['email'],
            'password' => $check['password'],
        ])) {

            return redirect()->route('owner_projects');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }


    public function logout()
    {

        Auth::guard('owner')->logout();
        return redirect()->route('owner.loginForm');
    }


    public function registerForm()
    {


        return view('owner.register');
    }

    public function register(Request $request)
    {

        Owner::insert([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),


        ]);


        return redirect()->route('owner.loginForm');
    }

    public function index()
    {
        $owner = Auth::guard('owner')->user();
        $projects = $owner->projects()->get();
        return view('owner.projects.index', compact('projects'));
    }

    public function create()
    {
        $owners = Owner::all();
        return view('owner.projects.create', compact('owners'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'project_id' => 'required|min:3|numeric|unique:projects,project_id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:new,enhancement',
            'methodology' => 'required|string|max:255',
            'platform' => 'required|in:mobile,web,standalone',
            'deployment' => 'required|in:cloud,premise'

        ], [
            'project_id.unique' => 'The project ID already exists.'
        ]);


        $project = new Project;
        $ownerId = Auth::guard('owner')->user()->id;
        $project->project_id = $request->project_id;
        $project->title = $request->title;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->owner_id = $ownerId;
        $project->methodology = $request->methodology;
        $project->platform = $request->platform;
        $project->deployment = $request->deployment;

        // Create a new project with the owner_id set

        $project->save();





        return redirect()->route('owner_projects')->with('success', 'Project request submitted successfully');
    }
}
