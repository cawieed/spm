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
      <a class="btn" href="{{route('lead_developer.projects.index')}}" role="button" aria-expanded="false">
        Project Progress
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

  <div class="card-header">
    <h1>Project Information</h1>
  </div>

  <div class="card-body">


    <table class="table">
      <thead>
        <tr>

          <th>Project ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Type</th>
          <th>Duration</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>System Owner</th>
        </tr>
      </thead>
      <tbody>
        @php($i=1)

        <tr>

          <td>{{$project->id}}</td>

          <td>{{$project->title}}</td>
          <td>{{$project->description}}</td>
          <td>{{$project->type}}</td>
          <td>{{$project->duration}}</td>
          <td>{{$project->start_date}}</td>
          <td>{{$project->end_date}}</td>
          <td>{{$project->owner->name}}</td>



        </tr>

      </tbody>
    </table>
  </div>
</div>
@endsection