<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Carbon\Carbon;

class JobApplicationController extends Controller
{
    public function index(Request $request)
{
    $sortColumn = $request->query('sort', 'created_at');
    $sortDirection = $request->query('direction', 'desc');

    $allowedColumns = ['company', 'status', 'interview_date', 'next_date', 'created_at'];
    if (!in_array($sortColumn, $allowedColumns)) {
        $sortColumn = 'created_at';
    }

    $query = JobApplication::query();

    // Search functionality with query grouping
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('company', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->orWhere('position', 'like', "%$search%");
    }


    

    // Apply date filter correctly
    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Fetch paginated results with sorting
    $jobApplications = $query->orderBy($sortColumn, $sortDirection)->paginate(10);

    return view('job_applications.index', compact('jobApplications', 'sortColumn', 'sortDirection'));
}

    public function create()
    {
        return view('job_applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'response' => 'nullable|string|max:255',
            'step' => 'nullable|string|max:255',
            'interview_date' => 'nullable|date',
            'next_date' => 'nullable|date',
            'status' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);
    
        // Ensure empty dates are stored as NULL
        $data = $request->except(['interview_date', 'next_date']);
        $data['interview_date'] = $request->filled('interview_date') ? $request->interview_date : null;
        $data['next_date'] = $request->filled('next_date') ? $request->next_date : null;
    
        JobApplication::create($data);
    
        return redirect()->route('job-applications.index')->with('success', 'Job application added successfully!');
    }
    


    public function edit($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        return view('job_applications.edit', compact('jobApplication'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'response' => 'nullable|string|max:255',
            'step' => 'nullable|string|max:255',
            'interview_date' => 'nullable|date',
            'next_date' => 'nullable|date',
            'status' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->update([
            'company' => $request->company,
            'response' => $request->response,
            'step' => $request->step,
            'interview_date' => $request->interview_date ? Carbon::parse($request->interview_date)->format('Y-m-d') : null,
            'next_date' => $request->next_date ? Carbon::parse($request->next_date)->format('Y-m-d') : null,
            'status' => $request->status,
            'position' => $request->position,
        ]);

        return redirect()->route('job-applications.index')->with('success', 'Job application updated successfully!');
    }

    public function destroy($id)
    {
        $jobApplication = JobApplication::findOrFail($id);
        $jobApplication->delete();

        return redirect()->route('job-applications.index')->with('success', 'Job application deleted successfully!');
    }

    public function export()
    {
        $jobApplications = JobApplication::all();

        $csvFileName = 'job_applications_' . now()->format('Y-m-d') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($jobApplications) {
            $file = fopen('php://output', 'w');

            // Add CSV column headers
            fputcsv($file, ['Company', 'Response', 'Step', 'Interview Date', 'Next Date', 'Status', 'Position', 'Created At']);

            // Add each job application to the CSV
            foreach ($jobApplications as $job) {
                fputcsv($file, [
                    $job->company,
                    $job->response,
                    $job->step,
                    $job->interview_date ? Carbon::parse($job->interview_date)->format('Y-m-d') : '',
                    $job->next_date ? Carbon::parse($job->next_date)->format('Y-m-d') : '',
                    $job->status,
                    $job->position,
                    Carbon::parse($job->created_at)->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
