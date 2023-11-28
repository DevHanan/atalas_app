<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class <?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    use ApiResponse;

    public function aboutUs(){

        $page = Page::where('type','about_us')->first();

        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }

    public function terms(){

        $page = Page::where('type','terms')->first();
        return $this->okApiResponse(new PageResource($page),__('page loaded'));
    }
}
SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "image"=> url($this->image)
        ];
    }
}
