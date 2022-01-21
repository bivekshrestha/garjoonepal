<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as DefaultBaseController;

class Controller extends DefaultBaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
