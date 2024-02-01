@extends('layouts.app')
@section('content')
<div class="container">
  <form method="POST" action="{{ route('owner.projects.store') }}">

    @csrf
    <div class="card mb-3">
      <div class="card-header">Submit Project Request</div>
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
          <label for="title" class="col-sm-2 col-form-label">Project Title</label>
          <div class="col-sm-10">
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
            @error('title')
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
          <label for="description" class="col-sm-2 col-form-label">Project Type</label>
          <div class="col-sm-10">
            <select class="form-select" id="type" name="type" required>
              <option value="new">New System</option>
              <option value="enhancement">Enhancement</option>
            </select>
            @error('type')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="methodology" class="col-sm-2 col-form-label">Project Methodology</label>
          <div class="col-sm-10">
            <input type="text" name="methodology" class="form-control" id="methodology" value="{{ old('methodology') }}">
            @error('methodology')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group  row mb-3">
          <label for="platform" class="col-sm-2 col-form-label">Project Platform</label>
          <div class="col-sm-10">
            <select class="form-select" id="platform" name="platform" required>
              <option value="mobile">Mobile Application</option>
              <option value="web">Web Application</option>
              <option value="standalone">Stand Alone System</option>
            </select>
            @error('platform')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>

        <div class="form-group  row mb-3">
          <label for="deployment" class="col-sm-2 col-form-label">Project Deployment Type</label>
          <div class="col-sm-10">
            <select class="form-select" id="deployment" name="deployment" required>
              <option value="cloud">Cloud</option>
              <option value="premise">On-premises</option>
            </select>
            @error('deployment')
            <strong style="width: 100%; margin-top: 0.25rem; font-size: 80%;color: #e3342f;">{{ $message }}</strong>
            @enderror
          </div>
        </div>




      </div>
    </div>
    <div class="text-center">
      <a class="btn btn-warning " href="{{route('owner_projects')}}">Back</a>
      <input class="btn btn-primary" type="submit" value="Submit">
    </div>
  </form>
</div>



@endsection