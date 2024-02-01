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
        <a class="btn" href="{{route('manager_projects')}}" role="button" aria-expanded="false">
          Projects
        </a>
        <button class=" btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{Auth::guard('manager')->user()->name}}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('manager_projects_request')}}">Logout</a></li>
        </ul>
      </div>

    </ul>
  </header>

  <div class="card-header">
    <h1>List of Projects Requests</h1>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Project ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Type</th>
          <th>Approval</th>
          <th>System Owner</th>

        </tr>
      </thead>
      <tbody>
        @php($i=1)
        @foreach($projects as $project)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$project->project_id}}</td>
          <td>{{$project->title}}</td>

          <td>{{$project->description}}</td>
          <td>{{$project->type}}</td>
          <td>
            <form action="{{ route('manager.projects.approve', $project->id) }}" method="POST">
              @csrf
              @method('PUT')
              <button class="btn btn-primary type=" submit">Approve</button>
            </form>
          </td>
          <td>
            {{$project->owner->name}}
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