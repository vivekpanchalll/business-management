<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\DataTables\BranchDataTable;

class BranchController extends Controller
{
    public function index(BranchDataTable $dataTable)
    {
        return $dataTable->render('branches.index');
    }
    
    public function create(){
        $businesses = Business::all();
        return view('branches.create', compact('businesses'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255',
            'week_days' => 'required|array',
            'week_days.*.*' => 'nullable|regex:/^\d{2}:\d{2}\s?-\s?\d{2}:\d{2}$/',
        ]);

        $branch = Branch::create([
            'business_id' => $request->input('business_id'),
            'name' => $request->input('name'),
        ]);

         $weekDaysData = $request->input('week_days');
         foreach ($weekDaysData as $day => $timeSlots) {
             foreach ($timeSlots as $timeSlot) {
                 $branch->timeSlots()->create([
                     'weekday' => $day,
                     'start_time' => $timeSlot['start'],
                     'end_time' => $timeSlot['end'],
                 ]);
             }
        }
        return redirect()->route('branches.index')->with('success', 'Branch created successfully!');
    }
}
