<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        );
        
        $data['js'] = array(
            '/lib/datatables/datatables.min.js',
            '/lib/datatables/dataTables.bootstrap5.min.js',
            '/lib/select/chosen.jquery.min.js', 
            '/js/master/user.js'
        );
        return view('user.index',[
            'title'  => 'User',
            'header' => '<i class="bi bi-people"></i>&nbsp;<b>Data Users</b>',
            'data'   => $data,
        ]);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTable(Request $request){

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('username',function ($data){
                    return $data->username;
                })
                ->addColumn('action', function($row){
                    $actionBtn = "<a id='edit_btn' type='button' class='text-primary' data-id=".$row->id." id='order_btn'><i class='bi bi-pencil-square'></i></a>
                    <a id='delete_btn' type='button' class='text-danger' data-id=".$row->id." data-name=".$row->name." id='order_btn'><i class='bi bi-trash3'></i></a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function getUser(Request $request){

        $username = $request->input('username');
        $data = DB::connection('sqlsrvcherry')->select("SELECT top(1) Name, Nik, Company, OfficeEmailAddress, Department FROM dbo.vw_employee_masterdata where Nik like '%$username' ");
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil',
            'data'    => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add',[
            'roles' => Role::all()
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
        $data = $request->validate([
            'username'   => 'required|string|unique:users',
            'name'       => 'required|string|max:255',
            'email'      => 'required|string',
            'perusahaan' => 'required|string',
            'divisi'     => 'required|string',
            'role_id'    => 'required|string',
        ]);

        $user = User::create([
            'username'   => $data['username'],
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => '',
            'perusahaan' => $data['perusahaan'],
            'divisi'     => $data['divisi'],
            'role_id'    => $data['role_id'],
        ]);

        if($user){
            return response()->json([
                'success' => true,
                'message' => $request->input('username').' save successfully !',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Failed to save !"
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       return view('user.edit',[
            'data'  => $user,
            'roles' => Role::all()
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'username'   => 'required|string',
            'name'       => 'required|string|max:255',
            'email'      => 'required|string',
            'perusahaan' => 'required|string',
            'divisi'     => 'required|string',
            'role_id'    => 'required|string',
        ];
       
        if($request->username != $request->username_old){
            $rules['username'] = 'required|unique:users';
        }

        $validatedData =  $request->validate($rules);

        $data = User::where('id', $user->id)
        ->update($validatedData);
       
        if($data){
            return response()->json([
                'success' => true,
                'message' => $request->input('username').' update successfully !',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Failed to update !"
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, Request $request)
    {
        $data = User::find($user);
        $data->delete();
        return response()->json([
            'success' => true,
            'message' => $request->input('name').' successfully deleted !',
        ], 200);
    }
}
