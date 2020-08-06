<?php

namespace App\Http\Controllers\API;
use App\Http\Requests\Users\UserRequest as UserRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends BaseController
{
   
    private $data = [];
    public function register(UserRequest $request) {  
        $user = User::register($request->request->all());
        $this->setData($user);
        return $this->successResponse( $this->getData(), 'User register successfully.');   
    }
    
    public function login( Request $request) {
        if( !Auth::attempt([ 'email' => $request->email, 'password' => $request->password ])) {
            return $this->errorResponse( 'Unauthorized');     
        }
        
        $user = Auth::user();
        $this->setData($user);
        return $this->successResponse( $this->getData(), 'User Login Successfully');

    }

    public function setData(User $user) {
        $this->data[ 'token']  = $user->createToken('MyApp')->accessToken;
        $this->data[ 'name'] = $user->name;
    }

    public function getData() {
        return $this->data;
    }
}
