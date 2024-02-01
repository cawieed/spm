@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Project Progress</h1>

  <form method="POST" action="{{ route('lead_developer.progress.store', $project->id) }}">
    @csrf
    <div class="mb-3">
      <label for="progress_id" class="form-label">Progress ID</label>
      <input type="text" name="progress_id" class="form-control" id="progress_id">
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="status" class="form-select" required>
        <option value="ahead_of_schedule">Ahead of Schedule</option>
        <option value="on_schedule">On Schedule</option>
        <option value="delayed">Delayed</option>
        <option value="completed">Completed</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="date" class="form-label">Date</label>
      <input type="date" name="date" id="date" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Create Progress</button>
  </form>
</div>
@endsection