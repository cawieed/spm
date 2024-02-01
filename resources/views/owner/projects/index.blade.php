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
        <button class=" btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{Auth::guard('owner')->user()->name}}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('owner.logout')}}">Logout</a></li>
        </ul>
      </div>

    </ul>
  </header>
  <div class="card-header">

    <h1>List of Projects</h1>
  </div>
  <div class="card-body">
    <div> <a class="btn btn-primary float-end" href="{{route('owner.projects.create')}}">Add New</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Number.</th>
          <th>Project ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Type</th>
          <th>Methodology</th>
          <th>Platform</th>
          <th>Deployment</th>
          <th>Approval</th>

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
          <td>{{$project->methodology}}</td>
          <td>{{$project->platform}}</td>
          <td>{{$project->deployment}}</td>
          <td>
            @if ($project->is_approved == 0)
            <span class="badge bg-warning text-dark">Pending</span>
            @elseif ($project->is_approved == 1)
            <span class="badge bg-success">Approved</span>
            @endif
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