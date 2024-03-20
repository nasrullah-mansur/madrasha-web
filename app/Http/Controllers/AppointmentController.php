<?php

namespace App\Http\Controllers;

use App\Models\Chamber;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\AppointmentSendMailJob;
use App\DataTables\AppointmentDataTable;

class AppointmentController extends Controller
{

    public function index(AppointmentDataTable $dataTable)
    {
        return $dataTable->render('back.appointment.index');
    }

    public function create()
    {
        $title = 'Make an appointment';
        $chambers = Chamber::all();
        return view('front.appointment.index', compact('title', 'chambers'));
    }

    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:255',
            'select_day' => 'required|max:255',
            'chamber' => 'required|max:255',
        ]);

        $appointment = new Appointment();

        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->day = $request->select_day;

        $chamber = Chamber::where('id', $request->chamber)->firstOrFail();

        $appointment->chamber = $chamber->chamber_name;
        $appointment->fee = $chamber->fee;

        $appointment->save();

        dispatch(new AppointmentSendMailJob($appointment));

        return redirect()->route('appointment.create')->with(['success' => $appointment]);
    }

    public function delete(Request $request)
    {
        $appointment = Appointment::where('id', $request->id)->firstOrFail();

        $appointment->delete();
    }



    public function get_chambers(Request $request) {
        $dateDay = $request->dateDay;
        $day = explode(' ', $dateDay);
        $day = $day[count($day) - 1];

        $chambers = Chamber::with('times')->whereHas('days', function ($query) use ($day) {
            $query->where('days.day', $day);
        })->get();

        return $chambers ? $chambers : null;
    }


    // Get from ajax;
    public function get_day_time(Request $request)
    {
        return Chamber::where('id', $request->id)
            ->with(['daytime' => function ($query) {
                $query->where('status', 'ACTIVE');
            }])
            ->first();
    }


    // PDF;
    function pdf_create($id) {

        $appointment = Appointment::where('id', $id)->firstOrFail();

        $name = "appointment-$appointment->id.pdf";

        $pdf = Pdf::loadView('front.appointment.pdf', ["data" => $appointment]);
        return $pdf->download($name);


        // return view('front.appointment.pdf');

        return redirect()->back();
    }
}
