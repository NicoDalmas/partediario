<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CargarTrabajoController extends Controller
{
    public function index()
    {
    	 return view('cargartrabajos.cargartrabajos');
    }
}
