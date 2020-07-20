<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\ModDist;
use Validator;
use Hashids;
use Auth;
use DB;

class DistributorController extends Controller
{
    private $route = 'distributor';
    private $path  = 'Distributor';

    function __construct(){
        // put your magic
    }

    public function index(){
        $data = [
            'pagetitle'    => 'Soal Nomer 5. CRUD Distributor',
            'cardTitle'    => 'Soal Nomer 5. CRUD Distributor',
            'cardSubTitle' => '&nbsp;',
            'cardIcon'     => 'flaticon2-list-3',
            'breadcrumb'   => ['Index' => route($this->route . '.index')],
            'route'        => $this->route
        ];

        return view ($this->path.'.index', $data);
    }

    function ktable(Request $request){
        $post    = $request->input();
        $getData = ModDist::selectRaw('dist_id, dist_kode, dist_nama');
        $jmlData = ModDist::selectRaw('count(*) AS jumlah');
        $paging  = $post['pagination'];
        $search  = (!empty($post['query']) ? $post['query'] : null);

        if( isset($post['sort']) ){
            $getData->orderBy($post['sort']['field'], $post['sort']['sort']);
        }else{
            $getData->orderBy('dist_nama', 'DESC');
        }

        if(!empty($search)){
            foreach ($search as $value => $param) {
                if($value === 'generalSearch'){
                    $getData->whereRaw("(dist_kode LIKE '%".$param."%' OR dist_nama LIKE '%".$param."%')");
                    $jmlData->whereRaw("(dist_kode LIKE '%".$param."%' OR dist_nama LIKE '%".$param."%')");
                }else{
                    if($value !== 0 ){
                        $getData->where($value, $param);
                        $jmlData->where($value, $param);
                    }
                }
            }
            $awal = null;
        }

        $start = intval($paging['page']);
        $limit = intval($paging['perpage']);
        $awal  = ($start == 1 ? '0' : ($start * $limit) - $limit);

        $getData->offset($awal);
        $getData->limit($limit);
        $result = $getData->get();

        $jumlah          = $jmlData->first()->jumlah;
        $data['records'] = array();
        $rowIds          = [];
        $i               = 1 + $awal;

        foreach($result as $key => $value){
            $data['records'][] = [
                'no'        => (string)$i,
                'dist_kode' => $value->dist_kode,
                'dist_nama' => $value->dist_nama,
                'action'    => '<div class="dropdown dropdown-inline">
                                    <a href="'. route($this->route . '.edit', ['dist_id' => Hashids::encode($value->dist_id)]) .'" class="btn btn-icon btn-clean btn-sm mr-2 ajaxify" data-toggle="tooltip" data-theme="dark" title="Edit"><i class="flaticon-edit text-warning"></i></a>
                                    <a href="'. route($this->route . '.delete', ['dist_id' => Hashids::encode($value->dist_id)]) .'" onClick="return f_action(this, event)" class="btn btn-icon btn-clean btn-sm mr-2" data-toggle="tooltip" data-theme="dark" title="Delete"><i class="flaticon-delete text-danger"></i></a>
                                </div>'
                                
            ];

            $i++;
        }

        $encode = (object)[
            'meta' => ['page' => $start, 'pages' => $limit, 'perpage' => $limit, 'total' => $jumlah, 'sort' => 'asc', 'field' => 'RecordID', 'rowIds' => $rowIds],
            'data' =>  $data['records']
        ];

        echo json_encode($encode);
    }

    function show(){
        $data = [
            'pagetitle'    => 'Page Distributor',
            'cardTitle'    => 'Card Distributor',
            'cardSubTitle' => 'Form tambah Distributor',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Show' => route($this->route . '.show')],
            'route'        => $this->route
        ];

        return view($this->path . '.show', $data);
    }

    function store(Request $request){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'dist_kode' => 'required|unique:distributor',
                'dist_nama' => 'required',
            ],
            [
                'dist_kode.required' => 'Kode tidak boleh kosong',
                'dist_nama.required' => 'Nama tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            $error     = '';
            $validator = $validator->errors()->messages();
            foreach ($validator as $key => $value) {
                $error .= ' - ' . $value[0] . '<br>';
            }

            $response['status']  = 2;
            $response['message'] = $error;

            echo json_encode($response);
            return;
        }

        DB::beginTransaction();

        try {
            ModDist::create($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di simpan';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function edit($dist_id){
        $data = [
            'pagetitle'    => 'Page Edit',
            'cardTitle'    => 'Card Edit',
            'cardSubTitle' => 'Form edit edit',
            'cardIcon'     => 'flaticon-file-1',
            'breadcrumb'   => ['Index' => route($this->route . '.index'), 'Edit' => route($this->route . '.edit', ['dist_id' => $dist_id]) ],
            'route'        => $this->route,
            'dist_id'      => $dist_id,
            'records'      => ModDist::selectRaw('dist_nama, dist_kode')->where('dist_id', Hashids::decode($dist_id)[0])->first()
        ];

        return view($this->path . '.edit', $data);
    }

    function update(Request $request, $dist_id){
        $post      = $request->input();
        $validator = Validator::make(
            $post,
            [
                'dist_nama' => 'required',
                'dist_kode' => 'required',
            ],
            [
                'dist_nama.required' => 'Nama tidak boleh kosong',
                'dist_kode.required' => 'Deskripsi tidak boleh kosong',
            ]
        );

        if ($validator->fails()) {
            $error     = '';
            $validator = $validator->errors()->messages();
            foreach ($validator as $key => $value) {
                $error .= ' - ' . $value[0] . '<br>';
            }

            $response['status']  = 2;
            $response['message'] = $error;

            echo json_encode($response);
            return;
        }

        DB::beginTransaction();

        try {
            Arr::forget($post, '_token');

            ModDist::where('dist_id', Hashids::decode($dist_id)[0])->update($post);

            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil diupdate';
        } catch (\Exception $ex) {

            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }

    function delete(Request $request, $dist_id){
        $post = $request->input();
        DB::beginTransaction();

        try {
            if(empty($post)){
                ModDist::where('dist_id', Hashids::decode($dist_id)[0])->delete();
            }else{
                ModDist::whereIn('dist_id', $post['ids'])->delete();
            }
            
            DB::commit();

            $response['status']  = 1;
            $response['message'] = 'Data berhasil di hapus';
        } catch (\Exception $ex) {
            DB::rollback();

            $response['status']  = 0;
            $response['message'] = $ex->getMessage();
        }

        echo json_encode($response);
    }
}
