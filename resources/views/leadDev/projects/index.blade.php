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
      @if ($project)
      <a class="btn" href="{{route('leadDev_project',$project)}}" role="button" aria-expanded="false">
        Project Information
      </a>
      @endif
      <div class="dropdown">
        <button class=" btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          {{Auth::guard('lead_dev')->user()->name}}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route('leadDev.logout')}}">Logout</a></li>
        </ul>
      </div>

    </ul>
  </header>
  @if ($project)
  <div class="card-header">
    <h1>{{$project->title}} : Project Progress</h1>
  </div>

  <div>
    <a class="btn btn-primary float-end" href="{{route('lead_developer.progress.create',$project)}}">Add Project Progress</a>

  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Date</th>
          <th>Description</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @php($i=1)
        @foreach($progress as $p)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$p->date}}</td>
          <td>{{$p->description}}</td>
          <td>{{$p->status}}</a></td>



        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <div class="card-body">
    <p>No project is assigned to you at the moment.</p>
  </div>
  @endif
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