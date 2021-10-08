<?php

namespace App\Models;

use App\Models\Feedback;
use App\Models\ServiceRating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['backer_id', 'service_id', 'status'];
    protected $appends = ['hasjobseekerfeedback','hasbackerfeedback', 'hasjsfeedback', 'hasbbfeedback'];
    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id')->with(['jobseeker']);
    }

    public function backer(){
        return $this->belongsTo(User::class, 'backer_id', 'id');
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }

    public function details(){
        return $this->hasOne(OrderDetail::class, 'order_id', 'id');
    }

    public function ratings(){
        return $this->hasMany(ServiceRating::class, 'order_id', 'id');
    }
    public function invoice(){
        return $this->hasOne(Invoice::class, 'order_id', 'id');
    }
    public function getHasJobseekerFeedbackAttribute(){
        
        if(ServiceRating::where('order_id', $this->id)->where('from', 'jobseeker')->exists()){
            return true;
        }else{
            return false;
        }
        
        // if(Feedback::where('service_id', $this->service_id)->where('from', 'jobseeker')->exists() != null){
        //     return false;
        // }else{
        //     return true;
        // }
    }
    public function getHasJSFeedBackAttribute(){
        return $this->ratings()->count() > 0 ? true : false;
    }
    
    public function getHasBackerFeedbackAttribute(){
        
        // $data = Feedback::where('service_id', $this->service_id)->where('from', 'backer')->get();
        // $data_id = $data->id;
        // dd($data_id);

        if(ServiceRating::where('order_id', $this->id)->where('from', 'backer')->exists()){
            return true;
        }else{
            return false;
        }
        
        // if(Feedback::where('service_id', $this->service_id)->where('from', 'backer')->exists()){
        //     return false;
        // }else{
        //     return true;
        // }
    }

    public function getHasBBFeedBackAttribute(){
        return $this->ratings()->count() > 0 ? true : false;
    }
}
