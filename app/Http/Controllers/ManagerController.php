<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\LeadDeveloper;
use App\Models\Developer;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;




class ManagerController extends Controller
{

    public function loginForm()
    {

        return view('manager.login');
    }

    public function login(Request $request)
    {

        $check = $request->all();

        if (Auth::guard('manager')->attempt([

            'email' => $check['email'],
            'password' => $check['password'],
        ])) {

            return redirect()->route('manager_projects');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }


    public function logout()
    {

        Auth::guard('manager')->logout();
        return redirect()->route('manager.loginForm');
    }


    public function registerForm()
    {


        return view('manager.register');
    }

    public function register(Request $request)
    {

        Manager::insert([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),


        ]);


        return redirect()->route('manager.loginForm');
    }

    public function index()
    {

        $latestProgress = [];

        // Loop through each project and retrieve its latest progress

        $p = Project::all();
        foreach ($p as $project) {
            $latestProgress[$project->id] = $project->progress()
                ->latest('date')
                ->first();
        }

        // Now, $latestDate contains the latest date and $latestStatus contains the latest status (if available)

        $projects = Project::where('is_approved', true)->get();
        return view('manager.projects.index', compact('projects', 'latestProgress'));
    }


    public function show(Project $project)
    {
        $developers = Developer::all();
        //$developers = Developer::where('role', 'developer')->get();
        $leadDevelopers = LeadDeveloper::whereDoesntHave('project')->get();
        return view('manager.projects.show', compact('project', 'developers', 'leadDevelopers'));
    }


    public function showrequest()
    {
        $projects = Project::where('is_approved', false)->get();
        return view('manager.projects.projectrequest', compact('projects'));
    }

    public function approve(Project $project)
    {
        $project = Project::findOrFail($project->id);
        $project->update(['is_approved' => true]);

        return redirect()->back()->with('success', 'Project approved successfully.');
    }





    public function showProjectProgresses(Project $project)
    {
        // Load the project progresses for the specified project
        $progress = $project->progress()->orderBy('date', 'asc')->get();

        return view('manager.projects.progresses', compact('project', 'progress'));
    }


    public function store(Request $request, Project $project)
    {

        $validated = $request->validate([
            'name' => 'required|min:4|string|max:255',
            'project_id' => 'required|min:3|numeric|unique:projects,project_id', // Make sure 'projects' is the correct table name
            'description' => 'required|min:4|string|max:255',
            'duration' => 'required|min:1|numeric',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ], [
            'project_id.unique' => 'The project ID already exists.',
            'end_date.after' => 'End Date should be after start date',
        ]);
        $project = new Project;
        $project->name = $request->name;
        $project->project_id = $request->project_id;
        $project->description = $request->description;
        $project->duration = $request->duration;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();

        return redirect()->route('manager_projects')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('manager.projects.edit', compact('project'));
    }

    /* Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|min:4|string|max:255',
            'project_id' => 'required|min:3|Numeric',
            'description' => 'required|min:4|string|max:255',
            'duration' => 'required|min:1|numeric',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after:start_date',
        ]);


        $project->update([
            'title' => $request->title,
            'project_id' => $request->project_id,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);



        return redirect()->route('manager_projects')->withSuccess('Project has been updated successfully');
    }



    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('manager_projects')->withSuccess('Project deleted successfully');
    }












    public function assignLeadDeveloper(Request $request, Project $project)
    {
        // Validate the form data
        $request->validate([
            'lead_developer_id' => 'required|exists:lead_developers,id',
        ]);

        $leadDeveloperId = $request->input('lead_developer_id');


        // Update the project with the new lead developer
        $project->leadDeveloper()->associate($leadDeveloperId);

        $project->save();

        return redirect()->route('manager_project', $project->id)->with('success', 'Lead Developer assigned successfully.');
    }



    public function unassignLeadDeveloper(Project $project)
    {
        // Detach the lead developer from the project
        $project->leadDeveloper()->dissociate();
        $project->save();
        return redirect()->route('manager_project', $project->id)->with('success', 'Lead Developer unassigned successfully.');
    }


    public function assignDeveloper(Request $request, Project $project)
    {
        // Validate the form data


        $request->validate([

            'developer_id' => 'required|exists:developers,id',
        ]);



        $project->developers()->sync($request->input('developer_id'));

        $project->save();

        return redirect()->route('manager_project', $project->id)->with('success', 'Developer assigned successfully.');
    }


    public function unassignAllDevelopers(Request $request, Project $project)
    {

        $project->developers()->detach();

        $project->save();

        return redirect()->route('manager_project', $project->id)->with('success', 'Developer assigned successfully.');
    }



    /*public function unassignLeadDeveloper($projectId, $leadDeveloperId)
    {
        $project = Project::findOrFail($projectId);
        $leadDeveloper = LeadDeveloper::findOrFail($leadDeveloperId);

        // Detach the lead developer from the project
        $project->leadDeveloper()->detach($leadDeveloper);

        return redirect()->route('projects.assignedLeadDeveloper', $project->id)
            ->with('success', 'Lead Developer unassigned successfully.');
    }*/
}
