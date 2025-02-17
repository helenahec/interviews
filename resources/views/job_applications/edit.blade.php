@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg p-4 bg-white rounded mx-auto" style="max-width: 600px;">
        <h2 class="text-center mb-4">
            <i class="fas fa-edit"></i> Edit Job Application
        </h2>

        <a href="{{ route('job-applications.index') }}" class="btn btn-secondary mb-3">
            ⬅ Back to Job Applications
        </a>

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
                <input type="text" name="company" class="form-control" value="{{ old('company', $jobApplication->company) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Response</label>
                <input type="text" name="response" class="form-control" value="{{ old('response', $jobApplication->response) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Step</label>
                <input type="text" name="step" class="form-control" value="{{ old('step', $jobApplication->step) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Interview Date</label>
                <input type="date" name="interview_date" class="form-control" 
                    value="{{ old('interview_date', $jobApplication->interview_date ? $jobApplication->interview_date->format('Y-m-d') : '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Next Step Date</label>
                <input type="date" name="next_date" class="form-control"
                    value="{{ old('next_date', $jobApplication->next_date ? $jobApplication->next_date->format('Y-m-d') : '') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="{{ old('status', $jobApplication->status) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $jobApplication->position) }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                💾 Update Job Application
            </button>
        </form>
    </div>
</div>
@endsection
