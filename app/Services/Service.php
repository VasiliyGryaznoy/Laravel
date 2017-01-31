<?php

namespace App\Services;

use DB;
use Exception;
use Log;

class Service
{
    protected function handleException(Exception $e)
    {
        DB::rollBack();
        
        Log::error($e->getMessage());
        Log::error($e->getTraceAsString());
        
        return false;
    }
    
    protected function handleSaveFileException(Exception $e)
    {
        Log::error($e->getMessage());
        Log::error($e->getTraceAsString());
    
        return ['result' => false, 'msg'  =>  'Something went wrong!'];
    }
}
