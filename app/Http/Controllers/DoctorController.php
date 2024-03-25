<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function DoctorList(){
        try {
            // Retrieve the authenticated user's ID
            $user_id = Auth::id();

            // Retrieve doctors associated with the authenticated user
            $doctor_data = Doctor::where('user_id', $user_id)->get();

            // Return success response with doctor data
            return response()->json(['status' => 'success', 'doctor_data' => $doctor_data]);
        } catch (Exception $e) {
            // Return failure response with error message
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    public function DoctorCreate(Request $request)
    {
        try {
            $user_id = Auth::id();
            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/doctor-img/{$img_name}";
            $img->move(public_path('uploads/doctor-img'), $img_name);

            Doctor::create([
                'img_url' => $img_url,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'specialization' => $request->input('specialization'),
                'degree' => $request->input('degree'),
                'mobile' => $request->input('mobile'),
                'hospital' => $request->input('hospital'),
                'chamber_address' => $request->input('chamber_address'),
                'registration_number' => $request->input('registration_number'),
                'user_id' => $user_id
            ]);
            return response()->json(['status' => 'success', 'message' => 'Doctor Create Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
