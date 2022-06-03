<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
       ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTable(Request $request){

        if ($request->ajax()) {
            $data = Permission::latest()->get();
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
        return view('permission.add');
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
