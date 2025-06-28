<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request){
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $makers = Maker::all();
        $blogs = Blog::with('user')->get();
        
        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'region', 'city', 'makers', 'models', 'fuelType', 'carType'])
            ->orderBy('published_at', 'desc')
            ->paginate(8);

        return view('home.index', compact('cars', 'carTypes', 'makers', 'blogs', 'fuelTypes'));
    }

    public function landing(Request $request){
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $makers = Maker::all();
        $blogs = Blog::with('user')->get();
        
        $cars = Car::where('published_at', '<', now())
            ->with(['primaryImage', 'region', 'city', 'makers', 'models', 'fuelType', 'carType'])
            ->orderBy('published_at', 'desc')
            ->paginate(8);

        return view('home.index', compact('cars', 'carTypes', 'makers', 'blogs', 'fuelTypes'));
    }

    public function brands(Request $request){
        $makers = Maker::all();

        $query = Car::where('published_at', '<', now())
            ->with('primaryImage', 'region', 'city', 'fuelType', 'carType', 'makers', 'models');

        if($request->has('maker')){
            $maker = Maker::where('name', $request->maker)->first();

            if($maker){
                $query->where('maker_id', $maker->id);
            }
        }

        $cars = $query->orderBy('published_at', 'desc')
            ->paginate(21)
            ->appends($request->query());

        return view('home.brands', compact('makers', 'cars'));
    }

    public function listings(){
        $cars = Car::where('published_at', '<', now())
            ->with('primaryImage', 'region', 'city', 'fuelType', 'carType', 'makers', 'models')
            ->orderBy('published_at', 'desc')
            ->paginate(20);
        return view('home.listings', compact('cars'));
    }

    public function blog(){

        $blogs = Blog::with('user')->paginate(16);
        return view('home.blog', compact('blogs'));
    }

    public function logout(Request $request)
    {
        //logout user
        Auth::logout();

        //Invalidate session
        $request->session()->invalidate();

        //generate new Tokens
        $request->session()->regenerateToken();

        //redirect to home page
        return redirect('/');
    }
}
