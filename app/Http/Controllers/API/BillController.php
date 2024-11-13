<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Bill_list;


class BillController extends Controller
{
    //

    public function print_bill($bill_id){

        $bill = Bill::where("bill_id",$bill_id)->get();
        $bill_list = Bill_list::where("bill_id",$bill_id)->get();

        return view("bill",compact('bill','bill_list'));

    }

    
}
