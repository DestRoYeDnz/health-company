<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendhcpStatusActiveEmailJob;
use App\Mail\hcpStatusActive;
use App\Mail\hcpStatusPy;

class UserController extends Controller
{
    function update(Request $request)
    {
        //return json_decode($request->getContent(), true);

        if (request()->isDirty) {

            if (request()->newValue == 'Active') {
                $user = User::where("id", request()->userId)->get();

                $output =  User::where('id', request()->userId)
                    ->update(
                        ['hcpStatus' => request()->newValue]
                    );

                $message = "Status Updated";


                if (request()->action == 'Yes') {
                    Mail::to($user)->send(new hcpStatusActive);
                    $mesage = "Status Updated - Email Sent";
                }
                return  Redirect::route('admin.users')->with('message', $message);
            }


            if (request()->newValue == 'Personal use only') {
                $user = User::where("id", request()->userId)->get();

                $output =  User::where('id', request()->userId)
                    ->update(
                        ['hcpStatus' => request()->newValue]
                    );
                $message = "Status Updated";

                if (request()->action == 'Yes') {
                    Mail::to($user)->send(new hcpStatusPy);
                    $mesage = "Status Updated - Email Sent";
                }

                return  Redirect::route('admin.users')->with('message', $message);
            }


            if (request()->newValue == 'Not Responding') {
                $user = User::where("id", request()->userId)->get();

                $output =  User::where('id', request()->userId)
                    ->update(
                        ['hcpStatus' => request()->newValue]
                    );
                    $message = "Status Updated";

                if (request()->action == 'Yes') {
                    //HUBSPOT HERE
                    $mesage = "Status Updated - Hubspot Create or Update Sent";
                }
                return  Redirect::route('admin.users', [
                    'message' => $message
                ]);
            }
        }
    }
}
