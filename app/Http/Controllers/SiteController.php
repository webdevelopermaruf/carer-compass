<?php

namespace App\Http\Controllers;

use App\Models\CarerProviders;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    public function forgetPassword(){
        return view('forget');
    }
    public function handleForgetPassword(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'user' => 'required|string'
        ]);
        if($validatedData['user']==='parent'){
            $parent = Parents::where('email',$validatedData['email'])->first();
            if($parent){
                Password::broker('parents')->sendResetLink(['email' => $validatedData['email']]);
                return redirect()->back()->with('success', 'Reset Password has sent to your email.!');

            }
        }else if($validatedData['user']==='carer'){
            $carer = CarerProviders::where('email',$validatedData['email'])->first();
            if($carer){
                Password::broker('carers')->sendResetLink(['email' => $validatedData['email']]);
                return redirect()->back()->with('success', 'Reset Password has sent to your email.!');

            }
        }else{
            $admin = User::where('email',$validatedData['email'])->first();
            if($admin){
                Password::sendResetLink(['email' => $validatedData['email']]);
                return redirect()->back()->with('success', 'Reset Password has sent to your email.!');

            }
        }
        return redirect()->back()->with('error', "We didn't recognize your email!");

    }

    public function resetPassword(string $token){
        return view('reset-password', ['token' => $token]);
    }

    public function view_profile()
    {
        $parent_id = Auth::guard('parent')->id();
        $carer_id = Auth::guard('carer')->id();
        if($parent_id){
            return view('parent.profile', ['profile'=> Auth::guard('parent')->user()]);
        }else if($carer_id){
            return view('carer.profile', ['profile'=> Auth::guard('carer')->user()]);
        }else{
            return redirect('/login');
        }


    }

    public function handleLogin(Request $request)
    {
        if($request->input('user') === 'parent'){
            if(Auth::guard('parent')->attempt(['email'=> $request->input('email'), 'password' => $request->input('password')])){
                $user = Auth::guard('parent')->user();
                Auth::guard('parent')->login($user);
                return redirect('/');
            }else{
                return redirect('/login')->with('error', 'Wrong Email or Password');
            }
        }
        else if($request->input('user') === 'admin'){
            if(Auth::attempt(['email'=> $request->input('email'), 'password' => $request->input('password')])){
                $user = Auth::user();
                Auth::login($user);
                return redirect('/');
            }else{
                return redirect('/login')->with('error', 'Wrong Email or Password');
            }
        }
        else{
            if(Auth::guard('carer')->attempt(['email'=> $request->input('email'), 'password' => $request->input('password')])){
                $user = Auth::guard('carer')->user();
                Auth::guard('carer')->login($user);
                return redirect('/');
            }else{
                return redirect('/login')->with('error', 'Wrong Email or Password');
            }
        }
    }

    public function search(Request $request)
    {
        $query = $request->query('q');
        if(auth()->guard('parent')->user()){
            $carers = CarerProviders::where('status', 1)->whereJsonContains('service_area', strtoupper($query))->paginate(4);
        }else{
            $carers = CarerProviders::where('status', 1)->whereJsonContains('service_area', strtoupper($query))->take(5)->paginate(4);
        }
        return view('search',['carers' => $carers]);
    }

    public function parent()
    {
        return view('parent.login');
    }

    public function carer()
    {
        return view('carer.login');
    }

    public function profile(string $id)
    {
        $carer = CarerProviders::with('review.parent')->where('id', $id)->first();
        return view('carer.public', ['carer' => $carer]);
    }

    public function register_parent(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:parents',
            'phone' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};\'":\\|,.<>\/?]).{8,}$/'
            ],
            'address' => 'required',
        ]);

        $create = Parents::updateOrInsert(
        ['email' => $validateData['email']],
        [
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'phone' => $validateData['phone'],
            'address' => $validateData['address'],
            'password' => bcrypt($validateData['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = Parents::where('email', $validateData['email'])->first();
        Auth::guard('parent')->login($user);
        return redirect('/');
    }

    public function logout()
    {
        auth()->guard('parent')->logout();
        auth()->guard('carer')->logout();
        auth()->logout();
        return redirect('/');
    }

    public function register_carer(Request $request)
    {
        // processing the service areas -> exploding by comma & trimming and upper-casing every element.
        $service_areas = array_map('strtoupper', array_map('trim',explode(",", $request->input('service_area'))));

        // updateOrInsert methods allow to either make update if it exists or insert new row if it doesn't exist.
        $create = CarerProviders::updateOrInsert(
            ['email' => $request->input('email')],
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'location' => $request->input('location'),
                'whatsapp' => $request->input('whatsapp'),
                'experience' => $request->input('experience'),
                'about' => $request->input('about'),
                'service_area' => json_encode($service_areas),
                'password' => bcrypt($request->input('password')),
                'training' => $request->input('training'),
                'status' => 0, // this means pending for system administrator approval
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        // getting the carer object.
        $user = CarerProviders::where('email', $request->input('email'))->first();

        // using Auth Facades login.blade.php to the selected user by passing into login.blade.php method.
        Auth::guard('carer')->login($user);
        return redirect('/');
    }

    public function Admin_carer(){
        $carers = CarerProviders::paginate(10);
        return view('carer',['carers' => $carers]);
    }
    public function Admin_parent(){
        $parents = Parents::paginate(10);
        return view('parent',['parents' => $parents]);
    }

    public function update_status(Request $request){
        if(auth()->user()){
            if($request->query('status') === 'approved'){
                $status = 1;
            }else if($request->query('status') === 'rejected'){
                $status = -1;
            }
            CarerProviders::where('id', $request->query('carer'))->update(['status' => $status]);
            return redirect()->back();
        }else{
            return redirect('/login');
        }
    }
    public function delete_carer(string $id){
        $delete = CarerProviders::where('id', $id)->delete();
        return redirect()->back();
    }
    public function delete_parent(string $id){
        $delete = Parents::where('id', $id)->delete();
        return redirect()->back();
    }
    public  function delete_account(){
        $parent_id = Auth::guard('parent')->id();
        $carer_id = Auth::guard('carer')->id();
        if($parent_id){
            $this->delete_parent($parent_id);
        }else if($carer_id){
            $this->delete_carer($parent_id);
        }
        $this->logout();
        return redirect()->to('/');
    }

    public function changePassword(Request $request){

        $validatedData = $request->validate([
            'reset_token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Get the email and token from the request
        $email = $validatedData['email'];
        $token = $validatedData['reset_token'];
        $password = $validatedData['password'];

        // Determine user type based on the email
        if ($parent = Parents::where('email', $email)->first()) {
            $userType = 'parents';
        } elseif ($carer = CarerProviders::where('email', $email)->first()) {
            $userType = 'carers';
        } elseif ($user = User::where('email', $email)->first()) {
            $userType = 'users';
        }

        $status = Password::broker($userType)->reset(
            [
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $request->input('password_confirmation'),
                'token' => $token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        // Handle reset result
        return match ($status) {
            Password::PASSWORD_RESET => redirect()->to('/login')->with('success', 'Your password has been changed.'),
            Password::INVALID_TOKEN => back()->withErrors(['reset_token' => 'The reset token is invalid or expired.']),
            Password::INVALID_USER => back()->withErrors(['email' => 'We can’t find a user with that email address.']),
            default => back()->withErrors(['email' => 'Something went wrong. Please try again.']),
        };
    }
    public function update_account(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'service_area' => 'required|string',
            'whatsapp' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'about' => 'nullable|string',
            'experience' => 'nullable|numeric|min:0|max:100',
            'training' => 'nullable|string',
        ]);
        $service_areas = array_map('strtoupper', array_map('trim',explode(",", $request->input('service_area'))));

        $profile = Auth::guard('carer')->user();
        // Update profile fields
        $profile->name = $request->name;
        $profile->location = $request->location;
        $profile->service_area = $service_areas;
        $profile->whatsapp = $request->whatsapp;
        $profile->phone = $request->phone;
        $profile->email = $request->email;
        $profile->about = $request->about;
        $profile->experience = $request->experience;
        $profile->training = $request->training;
        $profile->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
