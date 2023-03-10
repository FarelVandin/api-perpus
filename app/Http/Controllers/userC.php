<?php

namespace App\Http\Controllers;

use App\Models\userM;
use Illuminate\Http\Request;
use App\Http\Resources\userR;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userC extends Controller
{
    public function index()
    {
        $users = userM::latest()->paginate(5);

        return new userR(true, 'List Data User', $users);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all() , [
            'username'             => 'required',
            'password'               => 'required',
            'nama_user'               => 'required',
            'role'               => 'required',
            'no_hp'               => 'required'
        ]); 

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = userM::create([
            'username'         => $request->username,
            'password'                 => Hash::make($request->password),
            'nama_user'                 => $request->nama_user,
            'role'                 => $request->role,
            'no_hp'                 => $request->no_hp,
        ]);

        return new userR(true, 'Data User Berhasil Ditambahkan', $user);
    }

    public function show(userM $user){
        return new userR(true, 'Data User Ditemukan', $user);
    }

    public function update(Request $request, userM $user){
        $validator = Validator::make($request->all() , [
            'username'             => 'required',
            'password'               => 'required',
            'nama_user'               => 'required',
            'role'               => 'required',
            'no_hp'               => 'required'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }


            Storage::delete('public/user/'.$user->username);

            $user->update([
                'username'         => $request->username,
                'password'          => Hash::make($request->password),
                'nama_user'           => $request->nama_user,
                'role'                 => $request->role,
                'no_hp'                 => $request->no_hp,
            ]);

        return new userR(true, 'Data user Berhasil Diubah', $user);

    }

    public function destroy(userM $user){
        Storage::delete('public/user/'.$user->username);

        $user->delete();

        return new userR(true, 'Data User Berhasil Dihapus', null);
    }
}