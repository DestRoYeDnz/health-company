<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendhcpStatusActiveEmailJob;

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

                $details['email'] = "berer@sdafdsdfd.com";

                dispatch(new SendhcpStatusActiveEmailJob($details));


                return  Redirect::route('admin.users');
            }





            if (request()->newValue == 'Personal use only') {
                $user = User::where("id", request()->userId)->get();

                $output =  User::where('id', request()->userId)
                    ->update(
                        ['hcpStatus' => request()->newValue]
                    );
                return  Redirect::route('admin.users');
            }
            if (request()->newValue == 'Not Responding') {
                $user = User::where("id", request()->userId)->get();

                $output =  User::where('id', request()->userId)
                    ->update(
                        ['hcpStatus' => request()->newValue]
                    );
                return  Redirect::route('admin.users');
            }
        }
    }
}
