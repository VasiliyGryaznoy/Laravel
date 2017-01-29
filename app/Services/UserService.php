<?php

namespace App\Services;

use App\Models\User;
use DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    public function create($data)
    {
        try {
            DB::beginTransaction();
    
            $data['password'] = Hash::make($data['password']);
            
            $user = User::create($data);
            
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
        
        return $user;
    }
}
