<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\JobRequest;
use App\Models\BrushingService;
use App\Models\FinishingService;
use App\Models\Activity;

use App\Http\Requests\JobRequest as ApplayJob;
use App\Http\Requests\FinishingServiceRequest;
use App\Http\Requests\BrushingServiceRequest;

class ServiceController extends Controller
{
    use ApiResponse;
    public function applayJob(ApplayJob $request){
        $request->merge(['user_id'=>auth()->user()->id]);
        $data = JobRequest::create($request->except('cv'));
         if($request->hasFile('cv')){
              
            $thumbnail = $request->cv;
           $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
                   $thumbnail->move(public_path('/uploads/jobRequests/'),$filename);
            $data->cv ='uploads/jobRequests/'.$filename;
            $data->save();
         
        }
      return $this->okApiResponse($data,__('Applay Job done successfully')); 
    }
    public function ListJob(){
         $data = JobRequest::where('user_id',auth()->user()->id)->latest()->get();
      return $this->okApiResponse($data,__('List  Job done successfully')); 
    }
    
    
    
      public function activityRequest(Request $request){
        $request->merge(['user_id'=>auth()->user()->id]);
        $data = Activity::create($request->except('cv'));
      return $this->okApiResponse($data,__('Activity Request done successfully')); 
    }
    public function listActivityRequest(){
         $data = Activity::where('user_id',auth()->user()->id)->latest()->get();
      return $this->okApiResponse($data,__('List  Activity done successfully')); 
    }
    
    
    public function brushingServices(BrushingServiceRequest $request){
        $request->merge(['user_id'=>auth()->user()->id]);
        $data = BrushingService::create($request->all());
      return $this->okApiResponse($data,__('Brushing Service done successfully')); 
    }
    
        public function listBrushingServices(){
         $data = BrushingService::where('user_id',auth()->user()->id)->latest()->get();
      return $this->okApiResponse($data,__('List Brushing Service done successfully')); 
    }

    
    public function finishingServices(FinishingServiceRequest $request){
        $request->merge(['user_id'=>auth()->user()->id]);
        $request->merge(['rooms'=>json_encode($request->rooms)]);
        $data = FinishingService::create($request->all());
      return $this->okApiResponse($data,__('Finishing Service done successfully')); 
    }
    
     public function listFinishingServices(){
         $data = FinishingService::where('user_id',auth()->user()->id)->latest()->get();
      return $this->okApiResponse($data,__('List Finishing Service done successfully')); 
    }

}
