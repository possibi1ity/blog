<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\AdminRole;
use App\AdminPermission;



class RoleController extends Controller{
    public function index(){
        $roles = AdminRole::paginate();
        return view('admin/role/index',compact('roles'));
    }

    public function create(){

        return view('admin/role/create');
    }

    public function store(){
        $this->validate(request(),[
            'name' =>'required',
            'description' => 'required'
        ]);
        AdminRole::create(request(['name','description']));
        return redirect('admin/roles');
    }

    public function permission(AdminRole $role){

        $permissions = AdminPermission::all();
        $myPermissions = $role->permissions;
        // dd($permissions);

        return view('admin/role/permission',compact('permissions','myPermissions','role'));
    }
    public function permissionStore(AdminRole $role){
        $role->permissions()->detach();
        $role->permissions()->attach(request('permissions'));
        return back()->with('success','操作成功');
    }


}