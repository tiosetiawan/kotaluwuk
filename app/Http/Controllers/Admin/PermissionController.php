<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\ListMenuPermission;
use DataTables;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['css'] = array(
            '/lib/datatables/dataTables.bootstrap.min.css',
            '/lib/datatables/dataTables.bootstrap5.min.css',
			'/lib/select/component-chosen.min.css',
            '/lib/select/bootstrap-chosen.css',  
            '/lib/iconpicker/css/bootstrapicons-iconpicker.css'
        );
        
        $data['js'] = array(
            '/lib/datatables/datatables.min.js',
            '/lib/datatables/dataTables.bootstrap5.min.js',
            '/lib/select/chosen.jquery.min.js', 
            '/lib/iconpicker/js/bootstrapicon-iconpicker.js',
            '/js/master/permission.js'
        );

       return view('permission.index',[
            'title'  => 'Permissions',
            'header' => '<i class="bi bi-sliders2-vertical"></i>&nbsp;<b>Data Permissions</b>',
            'data'   => $data,
            'roles'  => Role::all()
       ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTable(Request $request){
        if ($request->ajax()) {
            $data = ListMenuPermission::select('*')
            ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = "<a id='edit_btn' type='button' class='text-primary' data-id=".$row->id." id='order_btn'><i class='bi bi-pencil-square'></i></a>
                    <a id='delete_btn' type='button' class='text-danger' data-id=".$row->id." data-name=".$row->name." id='order_btn'><i class='bi bi-trash3'></i></a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.add',[
            'roles'  => Role::all()
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
        $request->validate([
            'menu_name'  => 'required|string|max:255',
            'route_name' => 'required|string|max:255',
            'icon'       => 'required|string',
            'order_line' => 'required|string',
            'role'       => 'required|string',
        ]);

       try{
            $data = [
                'menu_name'  => $request->input('menu_name'),
                'route_name' => $request->input('route_name'),
                'icon'       => $request->input('icon'),
                'order_line' => $request->input('order_line'),
            ];

            $index  = $request->index;
            $create = $request->create;
            $edit   = $request->edit;
            $erase  = $request->erase;
            $role   = $request->role;

            if($index == "true"){
                $this->generatePermission($data, '-index',$role);
            }
            if($create == "true"){
                $this->generatePermission($data, '-create',$role);
            }
            if($edit == "true"){
                $this->generatePermission($data, '-edit',$role);
            }
            if($erase == "true"){
                $this->generatePermission($data, '-erase',$role);
            }
       
            return response()->json([
                'success' => true,
                'message' => $request->input('username').' save successfully !',
            ], 200);

       }catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => "Failed to save !"
            ], 401);
        }
    }


    function generatePermission($data, $suffix = '-index', $role){
        $roles = Role::where('id', '=', $role)->first();
        $data['name'] = strtolower($data['menu_name'] . $suffix);
        $permissions = Permission::create($data);
        $permissions->assignRole($roles->name);
        $this->assignPermissionToUser($permissions, $roles);
    }

    function assignPermissionToUser($permissions, $role){
        $users = User::leftJoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->select('users.*')
            ->where('model_has_roles.role_id', '=', $role->id)
            ->get();

        if ($users) {
            foreach ($users as $user) {
                $user->givePermissionTo($permissions->name);
            }
        }
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
}
