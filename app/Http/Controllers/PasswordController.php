<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\PasswordCategory\Category;
use App\Models\Role;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = new Category;
        $roles = new Role;

        if ( session()->get('is_authorised') == true && session()->exists('user_id') ) {
            $user_id    =   session()->get('user_id');
            $user_role  =   $roles->where('id','=',$user_id)->first();
            $all_roles  =   $roles->all();
            session()->put(['has_passwords'    =>  'true']);
            return view('password/create_password', [
                'categories'    =>  $categories->all(),
                'user_id'       =>  $user_id,
                'user_role'     =>  $user_role,
                'all_roles'     =>  $all_roles,
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name'              =>  'required|max:30',
            'user_id'           =>  'required',
            'category_id'       =>  'required',
            'value'             =>  'required',
            'login'             =>  'required',
            'tags',
            'description'       =>  'max:100',
            'password_role_id'  =>  'required',
        ]);

        $password = Password::create([
            'name'              =>  $request['name'],
            'user_id'           =>  $request['user_id'],
            'category_id'       =>  $request['category_id'],
            'value'             =>  $request['value'],
            'login'             =>  $request['login'],
            'tags'              =>  $request['tags'],
            'description'       =>  $request['description'],
            'password_role_id'  =>  $request['password_role_id'],
        ]);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Password::query()->where('id',$id)->delete();

    }

    public function delete() {

        $id = $_GET['id'];

        if ( session()->get('is_authorised') == true && session()->exists('user_id') ) {
            $this->destroy($id);
            return redirect()->route('home');
        } else {
            return redirect()->route('home');
        }
    }
}
