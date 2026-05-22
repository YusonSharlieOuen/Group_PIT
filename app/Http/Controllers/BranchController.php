<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::withCount(['staff', 'properties'])
            ->orderBy('branch_id')
            ->paginate(10);

        return view('Branch.index', compact('branches'));
    }

    public function create()
    {
        return view('Branch.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['required', 'string', 'max:10', 'unique:branch,branch_id'],
            'street' => ['nullable', 'string', 'max:100'],
            'area' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:50'],
            'postcode' => ['nullable', 'string', 'max:20'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'fax' => ['nullable', 'string', 'max:20'],
        ]);

        Branch::create($validated);

        return redirect()
            ->route('branch.index')
            ->with('success', 'Branch created successfully.');
    }

    public function show($branch)
    {
        $branch = Branch::with(['staff.supervisor', 'properties.staff'])
            ->findOrFail($branch);

        return view('Branch.show', compact('branch'));
    }

    public function edit($branch)
    {
        $branch = Branch::findOrFail($branch);

        return view('Branch.edit', compact('branch'));
    }

    public function update(Request $request, $branch)
    {
        $branch = Branch::findOrFail($branch);

        $validated = $request->validate([
            'street' => ['nullable', 'string', 'max:100'],
            'area' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:50'],
            'postcode' => ['nullable', 'string', 'max:20'],
            'telephone' => ['nullable', 'string', 'max:20'],
            'fax' => ['nullable', 'string', 'max:20'],
        ]);

        $branch->update($validated);

        return redirect()
            ->route('branch.show', $branch->branch_id)
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy($branch)
    {
        $branch = Branch::findOrFail($branch);
        $branch->delete();

        return redirect()
            ->route('branch.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
