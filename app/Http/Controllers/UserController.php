<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Models\PasswordCategory\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'roles' => $roles->all()->where('parent_id','>',1)
        ]);
    }

    public function find_user($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->first();
        $roles = Role::query()
            ->where('id', $user['role_id'])
            ->first();
        $userInfo[] = [
            'id'        =>  $user['id'],
            'firstname' =>  $user['firstname'],
            'surname'   =>  $user['surname'],
            'login'     =>  $user['login'],
            'password'  =>  $user['password'],
            'role'      =>  $roles['name'],
            'role_id'   =>  $roles['role_id'],
            'email'     =>  $user['email'],
        ];
        return $userInfo;
    }

    public function find_password_by_user($user_id)
    {

        $passwords = new Password;
        $passwords = $passwords
            ->all()
            ->where('user_id',$user_id); // all user's passwords

        foreach($passwords as $password) {

            $role = Role::query()
                ->where('id',$password['password_role_id'])
                ->first();  // password's role

            $category = Category::query()
                ->where('id',$password['category_id'])
                ->first();  // password's category

            $passwords_info[] = [
                'id'            =>  $password['id'],
                'name'          =>  $password['name'],
                'user_id'       =>  $password['user_id'],
                'category'      =>  $category['name'],          //category name
                'value'         =>  $password['value'],
                'login'         =>  $password['login'],
                'tags'          =>  $password['value'],
                'description'   =>  $password['description'],
                'role'          =>  $role['name'],              //role name
            ];
        }

        return $passwords_info;
    }


    public function authorisation()
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
            ->where('password',$request['password'])
            ->first();
        $id = $user['id'];
        if ($user) {
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
        $user = User::create([
            'role_id'           =>  $request['role_id'],
            'firstname'         =>  $request['firstname'],
            'surname'           =>  $request['surname'],
            'login'             =>  $request['login'],
            'email'             =>  $request['email'],
            'password'          =>  $request['password'],
            'remember_token'    =>  Str::random(10),
        ]);
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

        if ( session()->get('is_authorised') == true && session()->exists('user_id') && session()->get('has_passwords') == true ) {

            $id = session()->get('user_id');
            $userInfo = $this->find_user($id);

            $password = new Password;
            $userPasswords = $this->find_password_by_user($id); // user's passwords


            return view('user/userpage', [
                'user_info'         =>  $userInfo,
                'user_passwords'    =>  $userPasswords,
            ]);
        } elseif( session()->get('is_authorised') == true && session()->exists('user_id') && session()->exists('has_passwords') == false ) {

            $id = session()->get('user_id');

            $userInfo = $this->find_user($id);

            return view('user/userpage', [
                'user_info'         =>  $userInfo,
                'user_passwords'    =>  false,
            ]);
        } else {
            return redirect()->route('home');
        }
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
        if ( session()->get('is_authorised') == true && session()->exists('user_id') ) {
            $userInfo = $this->find_user($id);
            return view('user/edit_profile', ['user_info'    =>  $userInfo]);
        } else {
            return redirect()->route('home');
        }


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
        User::query()->where('id',$id)->delete();
    }

    public function delete()
    {
        if ( session()->get('user_id') == 1) {
            return redirect()->route('home');
        } else {

            if ( session()->get('is_authorised') == true && session()->exists('user_id') ) {

                $id = $_GET['id'];
                $this->destroy($id);
                session()->forget('is_authorised');
                session()->forget('user_id');
                return redirect()->route('home');

            } else {
                return redirect()->route('home');
            }
        }
    }
}
