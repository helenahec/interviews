@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Job Application</h2>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! There are some problems:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST">
        @csrf
        @method('PUT')  {{-- This ensures Laravel uses PUT instead of POST --}}
        
        <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control" value="{{ $jobApplication->company }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Response</label>
            <input type="text" name="response" class="form-control" value="{{ $jobApplication->response }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Step</label>
            <input type="text" name="step" class="form-control" value="{{ $jobApplication->step }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Interview Date</label>
            <input type="date" name="interview_date" class="form-control" value="{{ $jobApplication->interview_date }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Next Step Date</label>
            <input type="date" name="next_date" class="form-control" value="{{ $jobApplication->next_date }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $jobApplication->status }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control" value="{{ $jobApplication->position }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('job-applications.index') }}" class="btn btn-secondary">Back to Job Applications</a>
    </form>
</div>
@endsection
