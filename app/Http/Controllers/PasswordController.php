<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\PasswordCategory\PasswordCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = session()->get('user_id');
        $paginator = Password::where('user_id',$user_id)->paginate(8);

        return view('password/passwords',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = PasswordCategory::all();

            $user_id    =   session()->get('user_id');
            $user       =   User::find($user_id);
            $all_roles  =   Role::all();
            session()->put(['has_passwords'    =>  'true']);
            return view('password/create_password', [
                'categories'    =>  $categories,
                'user'          =>  $user,
                'all_roles'     =>  $all_roles,
            ]);
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
            'description'       =>  'max:100',
            'password_role_id'  =>  'required',
        ]);

        //метод fill чтобы не пришло лишнее
        $password = new Password();
        $password->fill([
            'name'              =>  $request['name'],
            'user_id'           =>  session()->get('user_id'),//брать из сессии
            //'category_id'       =>  $request['category_id'],
            'value'             =>  $request['value'],
            'login'             =>  $request['login'],
            'description'       =>  $request['description'],
            'password_role_id'  =>  $request['password_role_id'],
        ]);

        $password->push();
        foreach ($request['category_id'] as $category) {
            $password->categories()->attach($category);
        }

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
    {//
        $password = Password::find($id);
        $categories = PasswordCategory::all();//$password->categories();
        return view('password/edit_password',[
            'password'      =>  $password,
            'categories'    =>  $categories,
        ]);
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
        $password = Password::find($id);
        if ($password->categories()) {
            $password->categories()->detach();
        }
        $password->delete();

    }

    public function delete($id) {


        $this->destroy($id);
        return redirect()->route('user_passwords');
    }
}
