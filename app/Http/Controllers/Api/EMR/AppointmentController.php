<?php

namespace App\Http\Controllers\Api\EMR;

use App\Http\Controllers\Controller;
use App\Models\EMR\Appointment;
use App\Models\EMR\DoctorSpecialty;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user_type = $_GET['t'];
        if ($user_type == 'admin'){
            return response()->json([
                'all' => Appointment::latest()->with(['patient', 'doctor'])->paginate(20),
                'active' => Appointment::where('status', '=', 10)->paginate(20),
                'cancelled' => Appointment::where('status', '=', 0)->paginate(20),
                'pending' => Appointment::where('status', '=', 0)->paginate(20),
                'planned' => Appointment::where('status', '=', 1)->paginate(20),
            ]);
        } 
        else if ($user_type == 'patient'){
            return response()->json([
                'all' => Appointment::latest()->with(['doctor'])->paginate(20),
                'active' => Appointment::where('status', '=', 10)->paginate(20),
                'cancelled' => Appointment::where('status', '=', 0)->paginate(20),
                'pending' => Appointment::where('status', '=', 0)->paginate(20),
                'planned' => Appointment::where('status', '=', 1)->paginate(20),
                'specialties' => DoctorSpecialty::orderBy('name', 'ASC')->get(),
            ]);
        } 
    }

    public function store(Request $request)
    {
        //Check the values entered
        
        //Create new appointment
        $appointment = Appointment::create([
            'user_id' => auth('api')->id(), 
            'appointment_type_id' => 'Immediate', 
            'consultant_type_id' => $request->input('speciality_id'), 
            'complaint_type_id' => null, 
            'hospital_id' => null, 
            'doctor_id' => null, 
            'category_id' => null, 
            'complaint' => $request->input('complaint'), 
            'status' => 0, 
            'preferred_date' => date('Y-m-d'), 
            'preferred_time' => date('H:i:s'), 
            'fixed_time' => null, 
            'created_by' => auth('api')->id(), 
        ]);

        //Return regular values
        return response()->json([
            'all' => Appointment::latest()->with(['doctor'])->paginate(20),
            'active' => Appointment::where('status', '=', 10)->paginate(20),
            'cancelled' => Appointment::where('status', '=', 0)->paginate(20),
            'pending' => Appointment::where('status', '=', 0)->paginate(20),
            'planned' => Appointment::where('status', '=', 1)->paginate(20),
            'specialties' => DoctorSpecialty::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function show($id)
    {
        return response()->json([
            'appointment' => Appointment::where('id', '=', $id)->with('patient')->first(),
            //'appointment' => Appointment::find($id)->with('patient'),
            'user' => auth('api')->user(),
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
