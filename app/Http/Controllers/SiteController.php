<?php

namespace App\Http\Controllers;

use App\Models\CarerProviders;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Store a newly created resource in storage.
     */
    public function parent()
    {
        return view('parent.login');
    }

    /**
     * Display the specified resource.
     */
    public function carer()
    {
        return view('carer.login');
    }

    public function profile(string $id)
    {
        $carer = CarerProviders::with('review.parent')->where('id', $id)->first();
        return view('carer.profile', ['carer' => $carer]);
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
        $service_areas = $array = array_map('strtoupper', array_map('trim',explode(",", $request->input('service_area'))));

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
                'review' => json_encode([]),
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

    public function dashboard(){
        $carers = CarerProviders::paginate(10);
        return view('dashboard',['carers' => $carers]);
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
}
