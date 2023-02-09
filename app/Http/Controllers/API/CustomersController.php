<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\API\CustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class CustomersController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(CustomerRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = Customer::create($input);
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['full_name'] =  $user->full_name;
            DB::commit();
            return $this->sendResponse($success, 'User register successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**                                                                               
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $customer = $request->only('phone', 'password');
            if (Auth::guard('customer')->attempt($customer)) {
                $customer = Auth::guard('customer')->user();
                $success['token'] =  $customer->createToken('MyApp')->accessToken;

                return $this->sendResponse($success, 'User login successfully.');
            } else {

                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**                                                                               
     * info Login
     *
     * @return \Illuminate\Http\Response
     */
    public function infomation()
    {
        try {
            $customer = Auth::guard('api')->user();
            if ($customer) {
                return $this->sendResponse($customer, 'User login successfully.');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $customer = Auth::guard('api')->user();

        $customer->phone = $request->phone;

        $customer->save();
        if ($customer) {
            return $this->sendResponse($customer, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
