<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feedback;
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'duration', 'location'];
    protected $appends = ['hasjobseekerfeedback','hasbackerfeedback'];
    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id')->with(['jobseeker']);
    }

    public function backer(){
        return $this->belongsTo(User::class, 'backer_id', 'id');
    }

    public function getHasJobseekerFeedbackAttribute(){
        if(Feedback::where('service_id', $this->service_id)->where('from', 'jobseeker')->exists()){
            return true;
        }else{
            return false;
        }
    }

    public function getHasBackerFeedbackAttribute(){
        if(Feedback::where('service_id', $this->service_id)->where('from', 'backer')->exists()){
            return true;
        }else{
            return false;
        }
    }
}
