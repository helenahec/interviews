@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
<div class="container p-4 shadow-lg bg-white rounded" style="max-width: 1000px;">

        {{-- Title with proper spacing --}}
        <div class="mb-4">
    <h2 class="text-center mb-4">
        <i class="bi bi-journal-text"></i> Job Applications
    </h2>
    
    <form method="GET" action="{{ route('job-applications.index') }}" class="row g-2 justify-content-center align-items-center">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by company or position">
        </div>
        <div class="col-md-2">
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-auto">
            <button type="submit" class="btn btn-outline-primary">Search</button>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('job-applications.index') }}" class="btn btn-outline-secondary">Clear</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('job-applications.export') }}" class="btn btn-success">
                📥 Export to CSV
            </a>
        </div>
    </form>
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
                    <th>Date Applied</th>
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
                        <a href="{{ route('job-applications.edit', $job->id) }}" class="btn btn-sm btn-edit">Edit</a>
                            <form action="{{ route('job-applications.destroy', $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">Delete</button>
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
