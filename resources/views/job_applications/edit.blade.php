@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container p-4 shadow-lg bg-white rounded" style="max-width: 600px;">
        <h2 class="text-center mb-4">
            <i class="bi bi-pencil-square"></i> Edit Job Application
        </h2>

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
            @method('PUT')

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

            <div class="d-flex justify-content-between">
                <a href="{{ route('job-applications.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Job Applications
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Update Job
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
