<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scene;
use App\Hotspot;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahScene = Scene::all();
        $jumlahHotspot = Hotspot::all();

        return view('admin.index', compact('jumlahScene', 'jumlahHotspot'));
    }

    public function helpPage()
    {
        return view('admin.help');
    }

    public function virtualTour()
    {
        $fscene= DB::table('scenes')->where('status', '1')->first();
        $scenes= DB::table('scenes')->get();
        $hotspots = DB::table('hotspots')
            ->join('scenes', 'scenes.id', '=', 'hotspots.sourceScene')
            ->select('hotspots.*')
            ->get();

        return view('admin.virtual-tour', compact('fscene', 'scenes', 'hotspots'));
    }
}
