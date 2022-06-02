<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
            '/js/user/user.js'
        );
        return view('user.index',[
            'title' => 'User',
            'header' => '<i class="bi bi-people"></i>&nbsp;<b>Data Users</b>',
            'data'  => $data,
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
                    <a id='detail_data' type='button' class='text-danger' data-id=".$row->id." id='order_btn'><i class='bi bi-trash3'></i></a>";
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
        return view('user.add');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
