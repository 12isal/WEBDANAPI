<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;

class tamuController extends Controller
{
   public function index (){

    return view('tamu.halamanTamu');

   }
   public function kirim (Request $request ){
      $validator = $request->validate([
         'pesan' => 'required',
     ]);

     $user= 1;

  $tamu =Tamu::create([
      'pesan' =>$validator['pesan'], 
      'user_id' =>$user, 

         
   ]); 

     if ($tamu== null) {
      return 'gagal';
     }else{
      return 'berhasil';
     }


     



   }
}
