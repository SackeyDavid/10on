<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // use AuthorizesRequests {
    //     authorize as protected baseAuthorize;
    // }

    // public function authorize($ability, $arguments = [])
    // {
    //     if (Auth::guard('admin')->check()) {
    //         Auth::shouldUse('admin');
    //     }

    //     $this->baseAuthorize($ability, $arguments);
    // }
}
