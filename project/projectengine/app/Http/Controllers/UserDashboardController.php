<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Laravel\Ui\AuthCommand;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    public function showDashboard()
    {
        // Pobierz wszystkie oceny wraz z danymi użytkowników i napraw
        $ratings = Rating::with('user', 'repair')->paginate(5);

        return view('user.clientdashboard', ['ratings' => $ratings]);
    }

    public function showUserDevices()
    {
        $user = auth()->user();

        $devices = \App\Models\Device::where('user_id', $user->id)->paginate(10);

        return view('userdashboard.devices', ['user' => $user, 'devices' => $devices]);
    }
}