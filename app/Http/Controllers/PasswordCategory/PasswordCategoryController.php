<?php

namespace App\Http\Controllers\PasswordCategory;

use App\Http\Controllers\Controller;
use App\Models\PasswordCategory\PasswordCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PasswordCategoryController extends Controller
{
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $request->validate([
            'name'      =>  'required|min:6|max:40',
        ]);

        $this->store($request);

        //redirect
        return redirect()->route('home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
            $categories = $this->get_categories();

            return view('password/password_category/password_categories', [
                'categories' => $categories,
            ]);

    }

    public function get_categories()
    {
        $categories = PasswordCategory::all()->where('id','>',0);
        foreach ($categories as $category) {
            $data[] = [
                'id'        =>  $category['id'],
                'name'      =>  $category['name'],
                'parent_id' =>  $category['parent_id'],
            ];
        }
        return $data;
    }

    /**
     * @param int $id
     * @return array
     */
    public function get_category_by_id(int $id)
    {
        $category_info = PasswordCategory::find($id);

            return $category_info;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $data = $this->get_categories();

            return view('password/password_category/create_password_category', ['data' => $data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            // fill
            $passwordCategory=PasswordCategory::fill([
                'name'          =>  $request['name'],
                'parent_id'     =>  0,
            ]);

            // and push
            $passwordCategory->push();
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

            $data = $this->get_category_by_id($id);

            return view('password/password_category/edit_password_category',[
                'data' => $data
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
        $valid = $request->validate([
            'name'  =>  'required',
        ]);

        $category = DB::table('password_categories')
            ->where('id', $id)
            ->update([
                'name'      =>  $request['name'],
                'parent_id' =>  $request['parent_id']
            ]);
        return redirect()->route('password_category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            PasswordCategory::find($id)->delete();
    }
}
