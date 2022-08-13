<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        if($input['customerType'] === 'hcp'){

            Validator::make($input, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'customerType' => ['required', Rule::in(['hcp', 'consumer'])],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ])->validate();
    
    
    
            return User::create([
                'firstName' => $input['firstName'],
                'lastName' => $input['lastName'],
                'email' => $input['email'],
                'customerType' => 'hcp',
                'specialty'=> $input['specialty'],
                'password' => Hash::make($input['password']),
            ]);


        }

        if($input['customerType'] === 'consumer'){


            Validator::make($input, [
                'firstName' => ['required', 'string', 'max:255'],
                'lastName' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'customerType' => ['required', Rule::in(['hcp', 'consumer'])],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            ])->validate();
    
    
            if($input['authCode'] == 'X48'){
                $customerType = 'patient';
            } else {
                $customerType = 'consumer';
            }
    
            return User::create([
                'firstName' => $input['firstName'],
                'lastName' => $input['lastName'],
                'email' => $input['email'],
                'customerType' => $customerType,
                'authCode'=> $input['authCode'],
                'password' => Hash::make($input['password']),
            ]);


        }



    }

    public function createhcp(array $input)
    {
        Validator::make($input, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'customerType' => ['required', Rule::in(['hcp', 'consumer'])],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        if($input['authCode'] == 'X48'){
            $customerType = 'patient';
        } else {
            $customerType = 'consumer';
        }

        return User::create([
            'firstName' => $input['firstName'],
            'lastName' => $input['lastName'],
            'email' => $input['email'],
            'customerType' => $customerType,
            'authCode'=> $input['authCode'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
