@extends('layouts.app')
@section('content')
<div class="container">
  @if(session('success'))
  <h6 class="alert alert-success">
    {{ session('success') }}
  </h6>
  @endif

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
  <div class="card-header">
    <h1>{{$project->title}} : Project Progress</h1>
  </div>

  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>No.</th>
          <th>Progress ID</th>
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
          <td>{{$p->progress_id}}</td>
          <td>{{$p->date}}</td>
          <td>{{$p->description}}</td>
          <td>{{$p->status}}</a></td>



        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection