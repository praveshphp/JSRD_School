<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\MarkImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marks = Mark::when($request->has("s"), function ($q) use ($request) {
            return $q->where("roll_no", "like", "%" . $request->get("s") . "%");
        })->latest()->with('students')->paginate(10);

        return view('admin.marks.index', compact('marks'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marks.create');
    }
    public function createsingle()
    {

        return view('admin.marks.createsingle');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'marks_import_file' => 'required',
        ]);
        try {

            Excel::import(new MarkImport(), $request->file('marks_import_file'));
            return redirect()->route('marks.index')
                ->with('success', 'Students sheet imported successfully.');
        } catch (Exception $ex) {

            return redirect()->route('marks.create')->with('error', $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        $student = Student::where('roll_no', '=', $mark->roll_no)->first();
        return view('admin.marks.edit', compact('student', 'mark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        $request->validate([
            'subjects' => 'required',
            'half_yearly_max_marks' => 'required',
            'half_yearly_obtained' => 'required',
            'yearly_total_marks' => 'required',
            'yearly_obtained_marks' => 'required',
            'date' => 'required',
        ]);
        $mark->date  = \Carbon\Carbon::parse($mark->date)->format('d-m-Y');
        $mark->updated_at  = date('Y-m-d G:i:s');


        $mark->update($request->all());

        return redirect()->route('marks.index')
            ->with('success', 'Marks updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();

        return redirect()->route('marks.index')
            ->with('success', 'Marks deleted successfully');
    }
}
