@extends('layouts.app')

@section('content')
<div class="container">
  <header class="d-flex justify-content-end mx-3 mb-3">
    <ul class="nav " style="margin-left: auto;">
      <div class="dropdown">
        <a class="btn" href="{{route('manager_projects')}}" role="button" aria-expanded="false">
          Projects
        </a>
        <button class=" btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{Auth::guard('manager')->user()->name}}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('manager.logout')}}">Logout</a></li>
        </ul>
      </div>

    </ul>
  </header>
  <div class="card">


    <div class="card-header">
      <h1>Project Details</h1>
    </div>
    <div class="card-body">
      <table class="table">
        <tr>
          <td>Project ID</td>
          <td>{{ $project->project_id }}</td>
        </tr>
        <tr>
          <td>Project Title</td>
          <td>{{ $project->title }}</td>
        </tr>
        <tr>
          <td>Project Description</td>
          <td>{{ $project->description }}</td>
        </tr>

        <tr>
          <td>Assigned Lead Developer</td>
          <td>
            {{ $project->leadDeveloper ? $project->leadDeveloper->name : 'Not assigned' }}
          </td>
          <td>
            <form method="POST" action="{{ route('unassignLeadDeveloper', $project) }}" id="unassignLeadDeveloperForm">
              @csrf
              @method('POST')
              <button type="submit" class="btn btn-danger">Unassign</button>
            </form>
          </td>
        </tr>

        <tr>
          <td>Assigned Developers</td>
        </tr>
        @foreach($project->developers as $developer)
        <tr>
          <td>{{ $developer->id }}</td>
          <td>{{ $developer->name }}</td>
        </tr>
        @endforeach

        <tr>
          <td colspan="2">
            <form method="POST" action="{{ route('assignLeadDeveloper', $project) }}">
              @csrf
              <label for="lead_developer_id" class="form-label"><strong>Assign Lead Developer to Project</strong></label>
              <select class="form-select" id="lead_developer_id" name="lead_developer_id" required>
                <option value="">Select a Lead Developer</option>
                @foreach($leadDevelopers as $leadDeveloper)
                <option value="{{ $leadDeveloper->id }}">{{ $leadDeveloper->name }}</option>
                @endforeach
              </select>
              <button type="submit" class="btn btn-primary mt-2">Assign Lead Developer</button>
            </form>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <form method="POST" action="{{ route('assignDeveloper', $project) }}">
              @csrf
              <label for="developer_id" class="form-label"><strong>Assign Developers to Project</strong></label>
              <select class="form-select" id="developer_id" name="developer_id[]" required multiple>
                <option value="">Select Developers</option>
                @foreach($developers as $developer)
                <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                @endforeach
              </select>
              <button type="submit" class="btn btn-primary mt-2">Assign Developers</button>
            </form>
          </td>
          <td colspan="2">
            <form method="POST" action="{{ route('unassignAllDevelopers', $project) }}">
              @csrf
              <button type="submit" class="btn btn-danger mt-2">Unassign All Developers</button>
            </form>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection