<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles', compact('roles'));
    }

    /**
     *
     * @param int $id
     */
    public  function edit($id)
    {
        return view('edit_role', ['role' => Role::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $role = DB::table('roles')
            ->where('id',$request['id'])
            ->update([
                'name'  =>  $request['name'],
                'parent_id'  =>  $request['parent_id'],
            ]);
        return redirect()->route('roles');
    }
}
