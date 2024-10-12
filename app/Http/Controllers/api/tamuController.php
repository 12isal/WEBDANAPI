<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tamuController extends Controller
{

    public function pesamTamu( Request $request)
    {
    //    return ('test');
        try {
            $validated = $request->validate(
                [
                    'pesan' => 'required',
                ],
                [
                    'pesan.required' => 'Pesan harus di isi',
                ]
            );
            $user = auth()->user()->select('id', 'email', 'name')->first();
            
         

            $pesan= Tamu::create([
                'user_id' =>$user->id, 
                'pesan' =>$validated['pesan'], 

            ]);
           
        
         
            return response()->json(['message' => 'Data berhasil disimpan','data'=>$pesan,'user'=>$user], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }
     public function storeTamu( )
    {
   
        try {
            $tamu =DB::table('tamu')->join('users', 'tamu.user_id', '=', 'users.id')
            ->select(
                'tamu.id',          // Kolom ID dari tabel tamu
                'tamu.pesan',       // Kolom pesan dari tabel tamu
                'users.name as name',  // Nama pengguna dari tabel users
                'users.email as email'  // Email pengguna dari tabel users
            )
            ->orderBy('tamu.created_at', 'desc') // Mengurutkan hasil berdasarkan updated_at
            ->get();
            // $tamu = Tamu::with('user')->orderBy('created_at', 'desc')->get();
            // $tamu = User::join('tamu', 'tamu.user_id', '=', 'users.id')
            // ->select('users.*', 'tamu.pesan as tamu_pesan', 'users.email as user_email')
            // ->orderBy('tamu.created_at', 'desc')
            // ->get();
        
         
            return response()->json(['message' => 'Data berhasil ditampilkan','data'=>$tamu], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }
}
