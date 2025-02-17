@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container p-4 shadow-lg bg-white rounded" style="max-width: 600px;">
        <h2 class="text-center mb-4">📋 Add Job Application</h2>

        {{-- Back to Index Button --}}
        <a href="{{ route('job-applications.index') }}" class="btn btn-secondary mb-3">← Back to Job Applications</a>

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

        <form action="{{ route('job-applications.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Company</label>
                <input type="text" name="company" class="form-control" value="{{ old('company') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Response</label>
                <input type="text" name="response" class="form-control" value="{{ old('response') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Step</label>
                <input type="text" name="step" class="form-control" value="{{ old('step') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Interview Date</label>
                <input type="date" name="interview_date" class="form-control" value="{{ old('interview_date') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Next Step Date</label>
                <input type="date" name="next_date" class="form-control" value="{{ old('next_date') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="{{ old('status') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">💾 Save Application</button>
        </form>
    </div>
</div>
@endsection
