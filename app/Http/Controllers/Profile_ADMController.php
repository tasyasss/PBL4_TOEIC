<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile_ADMController extends Controller
{
     // Menampilkan halaman profile
     public function index()
     {
         return view('admin.profil');  
     }
 
     public function profil()
     {
         $breadcrumb = 'Profil Admin';
     
         return view('admin.profil', compact('breadcrumb'));
     }
}
