@extends('layouts.app')
@section('content')
<div class="container">
  <form method="POST" action="{{ route('manager_project_store') }}">

    @csrf
    <div class="card mb-3">
      <div class="card-header">Start New Project</div>
      <div class="card-body">
        <div class="form-group  row mb-3">
          <label for="project_id" class="col-sm-2 col-form-label">Project ID</label>
          <div class="col-sm-10">
            <input type="text" name="project_id" class="form-control" id="project_id" value="{{ old('project_id') }}">
            @error('project_id')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="name" class="col-sm-2 col-form-label">Project Name</label>
          <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
            @error('name')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="description" class="col-sm-2 col-form-label">Project Description</label>
          <div class="col-sm-10">
            <input type="text" name="description" class="form-control" id="description" value="{{ old('description') }}">
            @error('description')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>

        <div class="form-group  row mb-3">
          <label for="duration" class="col-sm-2 col-form-label">Project Duration</label>
          <div class="col-sm-10">
            <input type="text" name="duration" class="form-control" id="duration" value="{{ old('duration') }}">
            @error('duration')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div>

          <div class="form-group  row mb-3">
            <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-10">
              <input type="date" id="date" name="start_date" value="{{ old('start_date') }}">
              @error('start_date')
              <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
              @enderror
            </div>
          </div>


        </div>
        <div>

          <div class="form-group  row mb-3">
            <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
            <div class="col-sm-10">
              <input type="date" id="date" name="end_date" value="{{ old('old_date') }}">
              @error('end_date')
              <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
              @enderror
            </div>
          </div>


        </div>

      </div>
    </div>
    <div class="text-center">
      <a class="btn btn-warning " href="{{route('manager_projects')}}">Back</a>
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