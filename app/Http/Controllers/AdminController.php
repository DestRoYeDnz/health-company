<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function show()
    {
        return Inertia::render('Admin/Index',[
            'name' => 'booo'
        ]);
    }
    public function allUsers()
    {
        return Inertia::render('Admin/Users',[
            'users' => User::all()
        ]);
    }
    public function allWebhookOrders()
    {
        Order::all();
    }
}
