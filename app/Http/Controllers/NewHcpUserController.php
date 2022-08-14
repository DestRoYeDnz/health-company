<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewHcpUserController extends Controller
{

    public function newHcpUser(Request $request)
    {

        if (strval($request->resale) === "1") {
            $resale = true;
        } else if (strval($request->resale === "0")) {
            $resale = false;
        }

        $validated = $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'customerType' => ['required', Rule::in(['hcp', 'consumer'])],
            'password' => 'required',
            'certificateFile' => 'required',
            'certificateFile.*' => 'required|mimes:pdf|max:2048',
            'resaleCertificateFile' => Rule::requiredIf($resale),
            'resaleCertificateFile.*' => 'required|mimes:pdf|max:2048',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);


        $path = Storage::putFile('certificates', $request->file('certificateFile'));
        if($request->file('resaleCertificateFile')){
            $resalePath = Storage::putFile('resaleCertificate', $request->file('resaleCertificateFile'));
        } else {
            $resalePath = null;
        }
        


        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'customerType' => 'hcp',
            'hcpStatus' => 'Pending',
            'hcpSpecialty' => $request->specialty,
            'password' => Hash::make($request->password),
            'certificateFile' => $path,
            'certificateType' => $request->certificateType,
            'resaleCertificateFile' => $resalePath,
            'resale' => $request->resale,
            'hcpType' => $request->hcpType,
            'shippingType' => $request->shippingType,
            'hcpAddress' => $request->hcpAddress,
            'hcpSuite' => $request->hcpSuite,
            'hcpCity' => $request->hcpCity,
            'hcpPostcode' => $request->hcpPostcode,
            'hcpCountry' => $request->hcpCountry,
            'hcpState' => $request->hcpState,
            'hcpEin' => $request->hcpEin,
            'hcpLegalBusinessName' => $request->hcpLegalBusinessName,
            'hcpPhoneNumber' => $request->hcpPhoneNumber,
            'resaleAgreementAccepted' => $request->acceptedTime,
            'resaleAgreementAcceptedVersion' => $request->acceptedVersion,
        ]);

        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        
    }
}
