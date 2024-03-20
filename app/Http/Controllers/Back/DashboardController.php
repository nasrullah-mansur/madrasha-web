<?php

namespace App\Http\Controllers\Back;

use App\Models\Blog;
use App\Models\Appointment;
use App\Models\ImageGallery;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Chamber;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
}
