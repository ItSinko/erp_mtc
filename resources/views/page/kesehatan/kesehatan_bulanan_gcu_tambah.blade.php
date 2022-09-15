@extends('adminlte.page')

@section('title', 'ERP')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0  text-dark">GCU Tambah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('kesehatan.dashboard') }}">Beranda</a></li>
                    <li class="breadcrumb-item active"><a href="/kesehatan/bulanan/">Kesehatan Bulanan</a></li>
                    <li class="breadcrumb-item ">GCU Tambah</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@stop
@section('adminlte_css')
<style>
    table { border-collapse: collapse; empty-cells: show; }

    td { position: relative; }

    .foo {
        border-radius: 50%;
        float: left;
        width: 10px;
        height: 10px;
        align-items: center !important;
    }

    tr.line-through td:not(:nth-last-child(-n+2)):before {
        content: " ";
        position: absolute;
        left: 0;
        top: 35%;
        border-bottom: 1px solid;
        width: 100%;
    }

    @media screen and (min-width: 1440px) {

        body {
            font-size: 14px;
        }

        #detailmodal {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
        }


    }

    @media screen and (max-width: 1439px) {
        body {
            font-size: 12px;
        }

        h4 {
            font-size: 20px;
        }

        #detailmodal {
            font-size: 12px;
        }

        .btn {
            font-size: 12px;
        }


    }



</style>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data berhasil ditambahkan
        </div>
        @elseif(session()->has('error') || count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data gagal ditambahkan
        </div>
        @endif
        <div class="card">
            <div class="card-header  bg-success">
                <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pemeriksaan GCU (Glucose, Cholesterol, Uric ACID)</div>
            </div>
            <form action="/kesehatan/bulanan/gcu/aksi_tambah" method="post" enctype="multipart/form-data">

                <div class="card-body">
                    <div class="table-responsive">
                        {{ csrf_field() }}
                        <table class="table  table-striped table-hover" id="tabel_gcu" style="width:110%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th width="20%">Nama</th>
                                    <th width="10%">Glucose</th>
                                    <th width="10%">Cholesterol</th>
                                    <th width="10%">Uric Acid</th>
                                    <th>Catatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center;">
                                <tr>
                                    <td>1</td>
                                    <td><input type="date" class="form-control tgl_cek" name="tgl_cek[]"></td>
                                    <td><select class="form-control select2 karyawan_id" style="width:100%" name="karyawan_id[]">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach($karyawan as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control glukosa" name="glukosa[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="glukosa_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control kolesterol" name="kolesterol[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="kolesterol_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control asam_urat" name="asam_urat[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="asam_urat_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                    </td>
                                    <td>
                                        <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="card-footer">
                    <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan/bulanan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                    <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('#tabel_gcu').DataTable({
            "scrollX": true,
            "searching": false,
            "paging": false,
            "lengthChange": false,
            "info": false
        });
    });
</script>
<script>
    $(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('.tgl_cek').attr('name', 'tgl_cek[' + j + ']');
                $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + ']');
                $(el).find('.glukosa').attr('name', 'glukosa[' + j + ']');
                $(el).find('.kolesterol').attr('name', 'kolesterol[' + j + ']');
                $(el).find('.asam_urat').attr('name', 'asam_urat[' + j + ']');
                $(el).find('.keterangan').attr('name', 'keterangan[' + j + ']');


                $('.karyawan_id').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            var data = `     <tr>
            <td>1</td>
                                    <td><input type="date" class="form-control tgl_cek" name="tgl_cek[]"></td>
                                    <td><select class="form-control select2 karyawan_id" style="width:100%" name="karyawan_id[]">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach($karyawan as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control glukosa" name="glukosa[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="glukosa_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control kolesterol" name="kolesterol[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="kolesterol_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control asam_urat" name="asam_urat[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">mg/dl</span>
                                            </div>
                                        </div>
                                        <small id="asam_urat_status" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                    </td>
                                <td>
                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button>
                                                                   </td>
                            </tr>`;
            $('#tabel_gcu tr:last').after(data);
            numberRows($("#tabel_gcu"));
        });
        $('#tabel_gcu').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tabel_gcu"));
        });

    })
    $('.select2').select2();
</script>
@endsection
