@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
<div class="container p-4 shadow-lg bg-white rounded" style="max-width: 1000px;">

        {{-- Title with proper spacing --}}
        <h2 class="text-center my-4">
            📋 <strong>Job Applications</strong>
        </h2>
    <div class="row g-2 mb-3">
    <!-- Search Bar -->
    <div class="col-md-6">
        <form method="GET" action="{{ route('job-applications.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by company, status, or position"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <!-- Date Filters -->
    <div class="col-md-6 d-flex gap-2">
        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('job-applications.index') }}" class="btn btn-secondary">Clear</a>
    </div>
</div>


        {{-- Export Button with center alignment --}}
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('job-applications.export') }}" class="btn btn-success">
                📤 Export to CSV
            </a>
        </div>

        {{-- Job Applications Table --}}
        <table class="table table-striped table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Company</th>
                    <th>Response</th>
                    <th>Step</th>
                    <th>Interview Date</th>
                    <th>Next Date</th>
                    <th>Status</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobApplications as $job)
                <tr>
                    <td>{{ $job->company }}</td>
                    <td>{{ $job->response }}</td>
                    <td>{{ $job->step }}</td>
                    <td>{{ $job->interview_date }}</td>
                    <td>{{ $job->next_date }}</td>
                    <td>{{ $job->status }}</td>
                    <td>{{ $job->position }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('job-applications.edit', $job->id) }}" class="btn btn-warning btn-sm">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('job-applications.destroy', $job->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    🗑 Delete
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $jobApplications->links() }}
        </div>

        {{-- Add New Job Application Button --}}
        <div class="text-center mt-3">
            <a href="{{ route('job-applications.create') }}" class="btn btn-primary">➕ Add New Job Application</a>
        </div>

    </div>
</div>
@endsection
