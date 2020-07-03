<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Deployer;

class DeployController extends Controller
{
    //
    protected $deployer;

    public function __construct(Deployer $deployer)
    {
        $this->deployer = $deployer;
    }

    public function deploy(Request $request)
    {
        return $this->deployer->deploy($request);
    }
}
