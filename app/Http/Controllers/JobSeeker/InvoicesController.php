<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Http\Resources\Invoice  as ResourceInvoice;
use DataTables;
class InvoicesController extends Controller
{
    //
    public function index()
    {
        return view('jobseeker.contents.invoices');
    }

    public function data(){
        $user_id = auth()->user()->id;
        $results = Invoice::whereHas('order', function($q) use($user_id){
            $q->whereHas('service', function($q2) use($user_id){
                $q2->where('user_id', $user_id);
            });
        })->with('order')->get();

        return DataTables::of(ResourceInvoice::collection($results))->toJson();
    }
}
