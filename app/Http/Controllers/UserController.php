<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;
use Session;

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
        //Role::create(['name'=>'edit']);
        //Permission::create(['name' => 'edit']);
        
        //thêm quyền cho vai trò

            //khai báo biến vai trò
        // $role = Role::find(1);
            //khai báo biến quyền
        // $permission = Permission::find(2);
            //cấp quyền cho vai trò 
        // $role->givePermissionTo($permission);
            // quyền gán cho vai trò
        //$permission->assignRole($role);
        //echo auth()->user()->id;

        //auth()->user()->assignRole('admin');

        // $user = User::find(3);
        // $user->assignRole('edit');

        $user = User::with('roles','permissions')->orderBy('id','DESC')->get();

        return view('admincp.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admincp.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $user = new User();
        $user->password = Hash::make($data['password']);
        $user->email = $data['email'];
        $user->name = $data['tenuser'];
        $user->save(); 
        return redirect()->back()->with('status', 'Thêm thành công');
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
        //
    }

    public function phanvaitro($id)
    {
        $user = User::find($id);
        //$name_roles = $user->roles->first()->name;
        $role = Role::orderBy('id','DESC')->get();
        $permission = Permission::orderBy('id','DESC')->get();
        $all_column_roles = $user->roles->first();
        return view('admincp.user.phanvaitro', compact('user', 'role','permission', 'all_column_roles'));
    }

    public function inset_roles(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        
        //khi mà thêm quyền mới thì sẽ xóa quyền củ vì mỗi user chỉ có 1 quyền
        $user->syncRoles($data['role']);

        $role_id = $user->roles->first()->id;
        return redirect()->back()->with('status', 'thêm vai trò thành công');
    }

    

    public function phanquyen($id)
    {
        $user = User::find($id);
        //$name_roles = $user->roles->first()->name;
        $permission = Permission::orderBy('id','DESC')->get();
        $name_roles = $user->roles->first()->name;
        
        //lấy quyền
        $get_permission_via_role = $user->getPermissionsViaRoles();
        return view('admincp.user.phanquyen', compact('user','permission', 'name_roles', 'get_permission_via_role'));
    }

    public function inset_permission(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);

        $role_id = $user->roles->first()->id;

        $role = Role::find($role_id);
        $role->syncPermissions($data['permission']);

        return redirect()->back()->with('status', 'thêm Quyền thành công');
    }

    public function inset_per_permission(Request $request)
    {
        $data = $request->all();
        $permission = new Permission;
        $permission->name = $data['permission'];
        $permission->save();
        return redirect()->back()->with('status', 'thêm Quyền thành công');
    }

    public function impersonate($id)
    {
        $user = User::find($id);
        if ($user) {
            Session::put('impersonate', $user->id);
        }
        return redirect('/home');
    }
}
