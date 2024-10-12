<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
     /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        
    //    Log::info("dapat arai",$credentials);
       $user= DB::table('users')->where('email',$credentials['email'])->first();
       log::info('test',['user'=>$user]);

        if (! $token = JWTAuth::attempt($credentials)) {
            // log::info(auth()->attempt($credentials));
            // Log::error('tidak ada data',['credentials'=>$credentials]);
            return response()->json(['error' => 'email atau password salah'], 401);
        }

        return $this->respondWithToken($token);
    }
    public function register( Request $request)
    {
        // dd('Test');
       
        try {
            $validated = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:8',
                ],
                [
                    'name.required' => 'Nama harus di isi',
                    'email.required' => 'Email harus di isi',
                    'email.unique' =>'Email tidak cocok',
                    'password.required' => 'Password harus di isi',
                    'password.min' => 'Password Minimal 8 Karakter'
                ]
            );
            $hashedPassword = Hash::make($validated['password']);
            $role = 1;
           
            

            Log::info($hashedPassword);

            // Simpan pengguna ke database
            $user= User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $hashedPassword, // Gunakan password yang sudah di-hash
                'role_id' => $role
            ]);
        
         
            return response()->json(['message' => 'Data berhasil disimpan','data'=>$user], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
      

        // if($user){
        //     return response()->json(['pesan'=>'data berhasil dibuat'],200);
        // }else{
        //     return response()->json([['error' => 'Failed to create user'], 500]);
        // }
        //    $validator= Validator::make(request()->all(),[
        //     'name'=>'required',
        //     'email'=>'required|email',
        //     'password'=>'required|min:8',     
        // ],
        // [
        //     'name.required'=>'Nama harus di isi',
        //     'email.required'=>'email harus di isi',
        //     'password.required'=>'Password harus di isi',
        //     'password.min'=>'Password Minimal 8 Karakter'

        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()->all()], 422);
        // }
    
        // return response()->json(['message' => 'Data valid'], 200);
        
       
      

    
    }
   
    public function me()
    {

        $user = auth()->user();
        $role = Auth::user()->role->role;
        // $data = ['data'=>$user,];

        
            $data = [
                'name'=>$user->name,
                'email'=>$user->email,
                'role'=>$role,
                'created_at'=>$user->created_at,
                'updated_at'=>$user->updated_at,
           
            ];
        return response()->json(['message'=>'Data Valid','data'=>$data],200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
