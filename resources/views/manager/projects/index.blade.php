@extends('layouts.app')
@section('content')
<div class="container">
  @if(session('success'))
  <h6 class="alert alert-success">
    {{ session('success') }}
  </h6>
  @endif


  <header class="d-flex justify-content-end mx-3">
    <ul class="nav " style="margin-left: auto;">
      <div class="dropdown">
        <a class="btn" href="{{route('manager_projects_request')}}" role="button" aria-expanded="false">
          Projects Requests
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
  <h1>List of Projects</h1>
  <div class="card-body">
    <table class="table text-center">
      <thead>
        <tr>
          <th>No.</th>
          <th>Project ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Type</th>
          <th class="text-center">System Owner</th>
          <th class="text-center">Status</th>
          <th>Methodology</th>
          <th>Platform</th>
          <th>Deployment</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @php($i=1)
        @foreach($projects as $project)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$project->project_id}}</td>
          <td><a href="{{route('manager_project',$project)}}">{{$project->title}}</a></td>
          <td>{{$project->description}}</td>
          <td>{{$project->type}}</td>
          <td>{{$project->owner->name}}</td>
          <td>
            @if ($latestProgress[$project->id])
            Date: {{ $latestProgress[$project->id]->date }}<br>
            Status: {{ $latestProgress[$project->id]->status }}
            @else
            No progress recorded
            @endif
          </td>
          <td>{{$project->methodology}}</td>
          <td>{{$project->platform}}</td>
          <td>{{$project->deployment}}</td>
          <td>
            <div class="btn-group" role="group">
              <a class="btn btn-info rounded me-2" href="{{route('manager_project_edit',$project->id)}}">Info</a>
              <a class="btn btn-info rounded me-2" href="{{route('manager.projects.progresses',$project->id)}}">Progress</a>
              <form method="POST" action="{{ route('manager_project_destroy', $project->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>




<script>
  // Function to hide the success message after 3 seconds
  setTimeout(function() {
    var successMessage = document.querySelector('.alert-success'); // Select the success message element
    if (successMessage) {
      successMessage.style.display = 'none'; // Hide the message
    }
  }, 3000); // Hide the message after 3 seconds (3000 milliseconds)
</script>

@endsection