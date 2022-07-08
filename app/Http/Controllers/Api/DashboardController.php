<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\EMR\Appointment;
use App\Models\EMR\Doctor;
use App\Models\Finance\Wallet;
use App\Models\User;

use Carbon\Carbon;

class DashboardController extends Controller
{
    public function admin()
    {
        return response()->json([
            'balance' => Wallet::select('id', 'balance')->where('user_id', '=', auth('api')->id())->first(),
            'consultation' => Appointment::whereDate('created_at', '>=', Carbon::now()->subDays(7))->where('status', 4)->count(),
            'doc_reg' => Doctor::whereDate('created_at', '>=', Carbon::now()->subDays(7))->where('status', 0)->count(),
        ]);
    }
}
