<?php

namespace App\Services;
use App\Models\Deposit;
use Auth;

class DepositService
{
    /**
     * @param  Array  $data
     * @return int
     */
    public function create(Array $data): int
    {
        $depost = new Deposit();
        /**
         * Parameters are already validated
         */
        $depost->amount = $data["amount"];
        $depost->product_id = $data["product_id"];
        $depost->user_id = auth::id();
        $depost->save();
        
        return $depost->id;
    }
}