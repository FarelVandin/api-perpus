<?php

namespace App\Http\Controllers;

use App\Models\userM;
use Illuminate\Http\Request;
use App\Http\Resources\userR;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userC extends Controller
{
    public function index()

    {
        $users = userM::latest()->paginate(5);

        return new userR(true, 'List Data users', $users);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'nama_user' => 'required',
            'role' => 'required',
            'no_hp' => 'required',

        ]);
        
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

       

        $users = userM::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama_user' => $request->nama_user,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ]);
        return new userR(true, 'Data users Berhasil Ditambahkan!', $users);
    }

    public function show(userM $users){
        return new userR(true, 'Data users Ditemukan!', $users);
    }

    public function update(Request $request, userM $users){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
            'nama_user' => 'required',
            'role' => 'required',
            'no_hp' => 'required',
        ]);
        

        return new userR(true, 'Data users Berhasil Diubah!', $users);
    }

    public function destroy(userM $users){


        $users->delete();

        return new userR(true, 'Data users Berhasil Dihapus!', null);
    }

    }




