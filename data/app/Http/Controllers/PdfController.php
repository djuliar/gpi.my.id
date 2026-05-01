<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\LearningPlan;
use App\Models\WorkBook;
use App\Models\WorkBookEvent;
use App\Models\WebConfig;

class PdfController extends Controller
{
    public function printCover($code)
    {
        $course = Course::where('course_code', $code)->first();
        
        if($course != null){
            $workbook = WorkBook::where('course_id', $course->id)->first();
            $data = [
                'title' => 'BUKU KERJA PRAKTIK MAHASISWA',
                'subtitle' => '(BKPM)',
                'course' => $course,
                'workbook' => $workbook,
                'event' => WorkBookEvent::where('bkpm_id', $workbook->id)->orderBy('event_to', 'asc')->get(),
                'config' => WebConfig::where('id', 1)->first(),
            ];

        
            $html = View::make('pdf.bkpm_cover', $data)->render();

            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');
            return $pdf->stream('COVER ' . $data['subtitle'] . ' ' . $data['course']->course_code . ' - ' . $data['course']->course_name . '.pdf');
            // return view('pdf.bkpm_cover', $data);
        } else {
            abort(404);
        }
    }

    public function printEvent($code, $id)
    {
        $course = Course::where('course_code', $code)->first();
        $data = [
            'title' => 'BUKU KERJA PRAKTIK MAHASISWA',
            'subtitle' => '(BKPM)',
            'course' => $course,
            'workbook' => WorkBook::where('course_id', $course->id)->first(),
            'event' => WorkBookEvent::where('id', $id)->first(),
            'config' => WebConfig::where('id', 1)->first(),
        ];

        if($data['event'] != null){
            $html = View::make('pdf.bkpm_event', $data)->render();

            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');
            return $pdf->stream( $data['subtitle'] . ' ' . $data['course']->course_code . ' - ' . $data['course']->course_name . ' [' .str_replace('/' , '-', $data['event']->weeks) . '].pdf');
            // return view('pdf.bkpm_event', $data);
        } else {
            abort(404);
        }
    }

    public function printRpsCover($code)
    {
        $course = Course::where('course_code', $code)->first();
        
        if($course != null){
            $workbook = WorkBook::where('course_id', $course->id)->first();
            $plan = LearningPlan::where('course_id', $course->id)->first();
            $data = [
                'title' => 'RENCANA PEMBELAJARAN SEMESTER',
                'subtitle' => '(RPS)',
                'course' => $course,
                'workbook' => $workbook,
                'plan' => $plan,
                'config' => WebConfig::where('id', 1)->first(),
            ];

            $html = View::make('pdf.rps_cover', $data)->render();

            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');
            return $pdf->stream('COVER ' . $data['subtitle'] . ' ' . $data['course']->course_code . ' - ' . $data['course']->course_name . '.pdf');
            // return view('pdf.bkpm_cover', $data);
        } else {
            abort(404);
        }
    }
}
