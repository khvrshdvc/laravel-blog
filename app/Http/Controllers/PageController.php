<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   public function main()
   {
      return view('main', ['name' => 'Utkirbek']);
   }

   public function blog()
   {
      return view('blog');
   }

   public function contact()
   {
      return view('contact');
   }

   
}
