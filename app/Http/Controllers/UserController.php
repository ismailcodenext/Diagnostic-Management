<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{

    public function UserRegistration(Request $request)
    {
        try {
            // $request->validate([
            //     'firstName' => 'required|string|max:50',
            //     'lastName' => 'required|string|max:50',
            //     'email' => 'required|string|email|max:50|unique:users,email',
            //     'mobile' => 'required|string|max:50',
            //     'password' => 'required|string|min:3',
            //      // Add role validation
            // ]);

            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "uploads/user-img/{$img_name}";
            $img->move(public_path('uploads/user-img'), $img_name);

            $user = new User([
                'img_url' => $img_url,
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'), // Set the role based on user input
                'status' => $request->input('status'), // Default status to pending
            ]);

            $user->save();

            return response()->json(['status' => 'success', 'message' => 'User Registration Successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function UserLogin(Request $request){
        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Login Successful','token'=>$token]);

        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public function EmployerLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3',
            ]);

            $user = User::where('email', $request->input('email'))->where('role', 'employer')->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            if ($user->status === 'pending') {
                return response()->json(['status' => 'failed', 'message' => 'Your account is pending approval.']);
            }

            // If status is 'approved', continue with login
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Login Successful', 'token' => $token]);

        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

public function CandidateLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3',
            ]);

            $user = User::where('email', $request->input('email'))->where('role', 'candidate')->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['status' => 'failed', 'message' => 'Invalid User']);
            }

            if ($user->status === 'pending') {
                return response()->json(['status' => 'failed', 'message' => 'Your account is pending approval.']);
            }

            // If status is 'approved', continue with login
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Login Successful', 'token' => $token]);

        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function SendOTPCode(Request $request){

        try {

            $request->validate([
                'email' => 'required|string|email|max:50'
            ]);

            $email=$request->input('email');
            $otp=rand(1000,9999);
            $count=User::where('email','=',$email)->count();

            if($count==1){
                Mail::to($email)->send(new OTPMail($otp));
                User::where('email','=',$email)->update(['otp'=>$otp]);
                return response()->json(['status' => 'success', 'message' => '4 Digit OTP Code has been send to your email !']);
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Invalid Email Address'
                ]);
            }

        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function VerifyOTP(Request $request){

        try {
            $request->validate([
                'email' => 'required|string|email|max:50',
                'otp' => 'required|string|min:4'
            ]);

            $email=$request->input('email');
            $otp=$request->input('otp');

            $user = User::where('email','=',$email)->where('otp','=',$otp)->first();

            if(!$user){
                return response()->json(['status' => 'fail', 'message' => 'Invalid OTP']);
            }

            // CurrentDate-UpdatedTe=4>Min

            User::where('email','=',$email)->update(['otp'=>'0']);

            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'OTP Verification Successful','token'=>$token]);

        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ResetPassword(Request $request){

        try{
            $request->validate([
                'password' => 'required|string|min:3'
            ]);
            $id=Auth::id();
            $password=$request->input('password');
            User::where('id','=',$id)->update(['password'=>Hash::make($password)]);
            return response()->json(['status' => 'success', 'message' => 'Request Successful']);

        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(),]);
        }
    }

    function UserLogout(Request $request){
        $request->user()->tokens()->delete();
        return redirect('/userLogin');
    }

    function UsersLogout(Request $request){
        $request->user()->tokens()->delete();
    }

    public function getUserInformation(Request $request)
    {
        // Get the first name from the request
        $firstName = $request->input('firstName');

        // Retrieve the user by first name
        $user = User::where('firstName', $firstName)->first();

        if ($user) {
            return response()->json(['status' => 'success', 'user' => $user]);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'User not found']);
        }
    }

    public function UserProfile(Request $request)
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            return response()->json(['status' => 'fail', 'message' => 'Unauthorized'], 401);
        }
    }
    }




    function UpdateProfile(Request $request){

        try{
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'mobile' => 'required|string|max:50',
            ]);

            User::where('id','=',Auth::id())->update([
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'mobile'=>$request->input('mobile'),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Request Successful']);

        }catch (Exception $e){
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }



}
