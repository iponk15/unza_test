<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // put your magic
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'pagetitle'    => 'Dashboard',
            'cardTitle'    => NULL,
            'cardSubTitle' => NULL,
            'cardIcon'     => NULL,
            'breadcrumb'   => ['Index' => route('home')],
            'empat_a'      => Sales::selectRaw('sales_supervisor.sales_kode,sales_supervisor.sales_nama,d.dist_nama,p.target')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->where('p.target', '>=', '1000000')
                ->get(),
            'empat_b'      => Sales::selectRaw('sales_supervisor.sales_kode,sales_supervisor.sales_nama,d.dist_nama,p.target,MIN(p.target) AS min_target')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->get(),
            'empat_c'      => Sales::selectRaw('sales_supervisor.sales_kode,sales_supervisor.sales_nama,d.dist_nama,p.target,MAX(p.target) AS max_target')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->get(),
            'empat_d'      => Sales::selectRaw('sales_supervisor.sales_nama,d.dist_nama,count(d.dist_kode) as jmldist')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->groupBy('sales_supervisor.sales_kode')
                ->get(),
            'empat_e'      => Sales::selectRaw('sales_supervisor.sales_nama,d.dist_nama,MAX(p.target) as target')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->groupBy('sales_supervisor.sales_kode')
                ->get(),
            'empat_f'      => Sales::selectRaw('sales_supervisor.sales_nama,d.dist_nama,SUM(p.target) as target')
                ->leftJoin('pencapaian AS p', 'sales_supervisor.sales_kode', 'p.sales_kode')
                ->leftJoin('distributor AS d', 'p.dist_kode', 'd.dist_kode')
                ->groupBy('sales_supervisor.sales_kode')
                ->get(),
        ];

        return view('home', $data);
    }
}
