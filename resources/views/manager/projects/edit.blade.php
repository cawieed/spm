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
  <form method="POST" action="{{route('manager_project_update',$project)}}">
    @method('PATCH')
    @csrf
    <div class="card">
      <div class="card-header">Update Project Information</div>
      <div class="card-body">
        <div class="form-group  row mb-3">
          <label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
          <div class="col-sm-10">
            <input type="text" name="project_id" class="form-control" id="code" value="{{ $project->project_id }}">
            @error('project_id')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="title" class="col-sm-2 col-form-label">Title</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" value="{{ $project->title }}">
            @error('title')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="description" class="col-sm-2 col-form-label">Project Description</label>
          <div class="col-sm-10">
            <input type="text" name="description" class="form-control" id="description" value="{{ $project->description }}">
            @error('description')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>

        <div class="form-group  row mb-3">
          <label for="duration" class="col-sm-2 col-form-label">Project Duration</label>
          <div class="col-sm-10">
            <input type="text" name="duration" class="form-control" id="duration" value="{{ $project->duration }}">
            @error('description')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>


        <div class="form-group  row mb-3">
          <label for="start_date" class="col-sm-2 col-form-label">Project Start Date</label>
          <div class="col-sm-10">
            <input type="date" name="start_date" class="form-control" id="date" value="{{ $project->start_date}}">
            @error('start_date')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>


        <div class="form-group  row mb-3">
          <label for="end_date" class="col-sm-2 col-form-label">Project End Date</label>
          <div class="col-sm-10">
            <input type="date" name="end_date" class="form-control" id="date" value="{{ $project->end_date}}">
            @error('end_date')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-3">
      <a class="btn btn-warning " href="{{route('manager_projects')}}">Back</a>&nbsp;
      <input class="btn btn-secondary" type="reset" value="Reset"> &nbsp;
      <input class="btn btn-primary" type="submit" value="Submit">
    </div>
  </form>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#date", {
      dateFormat: "Y-m-d",
      enableTime: false,
    });
  });
</script>
@endsection