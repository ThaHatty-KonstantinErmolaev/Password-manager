<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use mysql_xdevapi\Session;

class UserController extends Controller
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
        $roles = new Role;

        return view('register', [
            'roles' => $roles->all()->where('id','>',1)
        ]);
    }

    public function authorization()
    {
        return view('login',['err'=>'']);
    }

    public function loginValidate(Request $request)
    {

        $valid = $request->validate([
            'login'     =>  'required',
            'password'  =>  'required',
        ]);

        $user = User::query()
            ->where('login',$request['login'])
            ->first();
        $pass = $user['password'];
        if ($user && Hash::check($request['password'], $pass)) {
            $id = $user['id'];
            $request->session()->put(['is_authorised' => 'true']);
            $request->session()->put(['user_id' => $id]);
            return redirect()->route('home');
        } else {
            return view('login', ['err'   =>  'Вы неправильно ввели данные']);
        }
    }

    public function exit(Request $request)
    {
        $request->session()->forget(['is_authorised']);
        $request->session()->forget(['user_id']);
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill([
            'role_id'           =>  $request['role_id'],
            'firstname'         =>  $request['firstname'],
            'surname'           =>  $request['surname'],
            'login'             =>  $request['login'],
            'email'             =>  $request['email'],
            'password'          =>  Hash::make($request['password']),
            'remember_token'    =>  Str::random(10),
        ]);
        $user->push();
    }

    public function userValidate(Request $request)
    {
        $valid = $request->validate([
            'role_id'   =>  'required',
            'firstname' =>  'required|max:20|string',
            'surname'   =>  'required|max:20',
            'login'     =>  'required|unique:users|min:6|max:20',
            'email'     =>  'required|min:6|max:40',
            'password'  =>  'required|min:6|max:30',
        ]);

        $this->store($request);

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

            $id = session()->get('user_id');
            $userInfo = User::find($id);
            $pas =  Password::where('user_id', $id)->paginate(3);
            $paginator = $userInfo->passwords()->paginate(3);

            return view('user/userpage', [
                'user_info'         =>  $userInfo,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = session()->get('user_id');
            return view('user/edit_profile', ['user_info'    =>  User::find($id)]);

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
        $id = session()->get('user_id');
        $valid = $request->validate([
            'firstname' =>  'required|max:20',
            'surname'   =>  'required|max:20',
            'login'     =>  'required|min:6|max:20',
            'email'     =>  'required|min:4|max:40',
            'password'  =>  'required|min:6|max:30',
        ]);

        $user = DB::table('users')
            ->where('id', $id)
            ->update([
                'firstname' =>  $request['firstname'],
                'surname' =>  $request['surname'],
                'login' =>  $request['login'],
                'email' =>  $request['email'],
                'password' =>  $request['password'],
            ]);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //User::query()->where('id',$id)->delete();
        $user = new User;
        $user->find($id)->delete();
    }

    public function delete()
    {
                $id = $_GET['id'];
                $this->destroy($id);
                session()->forget('is_authorised');
                session()->forget('user_id');
                return redirect()->route('home');
    }
}
