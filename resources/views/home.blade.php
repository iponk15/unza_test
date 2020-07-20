@extends('layouts.content')
@section('content')
<div class="row">
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 1</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <?php
                                for ($i = 1; $i < 100; $i++) {
                                    if ( $bagi = $i % 5 == 0 ) {
                                       echo ' X ';
                                    } else if ( $bagi = $i % 6 == 0 ) {
                                        echo ' Y ';
                                    } else {
                                        echo " " . $i . " "; 
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 2</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="10%">Soal</th>
                                            <th class="text-center">Jawaban</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">2.A</td>
                                            <td>
                                                <a target="_blank" href="https://www.wipro-unza.com/indonesia-id/" style="text-decoration: none; color: black">Wipro Unza</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2.B</td>
                                            <td><p style="font-size: 18px;font-family: Arial;">Wipro Unza</p></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2.C</td>
                                            <td><div style="background-color: red; width: 19px; height: 19px; padding: 1px; border: 1px solid green;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.A</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_a as $empata)
                                            <tr>
                                                <td>{{ $empata->sales_nama }}</td>
                                                <td>{{ $empata->dist_nama }}</td>
                                                <td class="text-center">Rp. {{ number_format($empata->target,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.B</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_b as $empatb)
                                            <tr>
                                                <td>{{ $empatb->sales_nama }}</td>
                                                <td>{{ $empatb->dist_nama }}</td>
                                                <td class="text-center">Rp. {{ number_format($empatb->min_target,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.C</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_c as $empatc)
                                            <tr>
                                                <td>{{ $empatc->sales_nama }}</td>
                                                <td>{{ $empatc->dist_nama }}</td>
                                                <td class="text-center">Rp. {{ number_format($empatc->max_target,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.D</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Jumlah Distributor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_d as $empatd)
                                            <tr>
                                                <td>{{ $empatd->sales_nama }}</td>
                                                <td>{{ $empatd->dist_nama }}</td>
                                                <td class="text-center">{{ $empatd->jmldist }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.E</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_e as $empate)
                                            <tr>
                                                <td>{{ $empate->sales_nama }}</td>
                                                <td>{{ $empate->dist_nama }}</td>
                                                <td class="text-center">Rp. {{ number_format($empate->target,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Soal 4.F</h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Example-->
                    <div class="example">
                        <div class="example-preview">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sales Nama</th>
                                            <th class="text-center">Dist Nama</th>
                                            <th class="text-center">Total Target</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($empat_f as $empat_f)
                                            <tr>
                                                <td>{{ $empat_f->sales_nama }}</td>
                                                <td>{{ $empat_f->dist_nama }}</td>
                                                <td class="text-center">Rp. {{ number_format($empat_f->target,2,',','.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
@endsection
