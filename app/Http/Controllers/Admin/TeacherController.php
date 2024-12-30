<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QuestionsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class TeacherController extends Controller
{

    public function export(Request $request, $id)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $teacher = Teacher::findOrFail($id);
        $fileName = $teacher->name . now()->format('Y_m_d') . '.xlsx';
        return Excel::download(new UsersExport($id, $startDate, $endDate), $fileName);
    }

    public function questionExport(Request $request, $id)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $teacher = Teacher::findOrFail($id);
        $fileName = $teacher->name . now()->format('Y_m_d') . '.xlsx';
        return Excel::download(new QuestionsExport($id, $startDate, $endDate), $fileName);
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers'));
    }


    public function create()
    {
        return view('admin.teachers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        Teacher::create($request->all());

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }



    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.show', compact('teacher'));
    }
    public function edit($id)
    {
        $teacher = Teacher::with('courses')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }


    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
