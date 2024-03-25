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
            $user_id = Auth::id();
            $doctor_data= Doctor::where('user_id', $user_id)->get();
            return response()->json(['status' => 'success', 'doctor_data' => $doctor_data]);
        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
