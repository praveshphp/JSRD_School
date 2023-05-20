<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Student;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.home');
        //return redirect()->route('front.home');
    }
    public function pages($slug)
    {
        $pages = Page::where('id', $slug)
            ->orWhere('slug', $slug)
            ->firstOrFail();

        return view('front.pages', compact('pages'));
    }

    public function contact()
    {
        return view('front.contact', compact('pages'));
    }
    public function results(Request $request)
    {
        $student = [];
        if ($request->has("roll_no")) {
            $roll_no = $request->get("roll_no");
            $student = Student::when($request->has("roll_no"), function ($q) use ($request) {
                return $q->where("roll_no", "=",  $request->get("roll_no"));
            })->latest()->with('marks')->paginate(10);
            if ($student->count() > 0) {
                $max_marks = 0;
                $obtained_marks = 0;
                foreach ($student as $s) {
                    foreach ($s->marks as $m) {
                        $max_marks_current = ($m->half_yearly_max_marks + $m->yearly_total_marks);
                        $obtained_marks_current  = ($m->half_yearly_obtained + $m->yearly_obtained_marks);
                        $max_marks = $max_marks + $max_marks_current;
                        $obtained_marks = $obtained_marks + $obtained_marks_current;
                    }
                }
                return view('front.results', compact('student', 'request', 'max_marks', 'obtained_marks', 'roll_no'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
            } else {

                return view('front.results', compact('request', 'roll_no'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
            }
        }

        return view('front.results', compact('request'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
        //return redirect()->route('front.home');
    }
    public function generatePDF(Request $request)
    {
        // define("DOMPDF_ENABLE_REMOTE", false);

        if ($request->has("roll_no")) {
            $student = Student::when($request->has("roll_no"), function ($q) use ($request) {
                return $q->where("roll_no", "=",  $request->get("roll_no"));
            })->latest()->with('marks')->paginate(10);
            if ($student->count() > 0) {
                $max_marks = 0;
                $obtained_marks = 0;
                foreach ($student as $s) {
                    foreach ($s->marks as $m) {
                        $max_marks_current = ($m->half_yearly_max_marks + $m->yearly_total_marks);
                        $obtained_marks_current  = ($m->half_yearly_obtained + $m->yearly_obtained_marks);
                        $max_marks = $max_marks + $max_marks_current;
                        $obtained_marks = $obtained_marks + $obtained_marks_current;
                    }
                }
                $D1 = file_get_contents(public_path('front/images/background.jpg'));
                $base64 = 'data:image/jpg;base64,' . base64_encode($D1);
                $data = [
                    'title' => 'J.S.R.D. International Public School',
                    'sub_title' => 'Ashok Nagar, Village: Gadiya Bharpura, Aliganj Etah',
                    'date' => date('m/d/Y'),
                    'logo' => public_path('front/images/buddha-clipart-wedding-buddha-wedding-transparent-40.png'),
                    'logo' => public_path('front/images/Daco_293270.png'),
                    'background' => $base64,
                    'student' => $student
                ];
                // print_r( $data );exit;
                //    extract($data);
                //    $logo=asset('front/images/9-2-saraswati-png-hd.png');
                //    return view('front.myPDF', compact('data','title','sub_title','date','logo','student'));

                $pdf = PDF::loadView('front.myPDF', $data);
                // $pdf->set_option('isFontSubsettingEnabled', true);
                // $pdf->set_option('isHtml5ParserEnabled', true);
                // $pdf->set_option('allowUrlFopen', true);
                $pdf->set_option('isRemoteEnabled', true);
                // $pdf->set_paper('letter', 'landscape');
                // return view('front.myPDF', $data);
                return $pdf->download($request->get("roll_no") . "_" . $student[0]->student_name . '.pdf');
            } else {
                return redirect()->route('front.results')->with('error', "No Result Found");
            }
        } else {
            return redirect()->route('front.results')->with('error', "No Result Found");
        }
    }
}
