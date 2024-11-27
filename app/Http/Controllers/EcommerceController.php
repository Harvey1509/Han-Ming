<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function home () {
        return view('ecommerce.home');
    }

    public function products () {
        return view('ecommerce.products');
    }

    public function complaints () {
        return view('ecommerce.complaints');
    }
}
