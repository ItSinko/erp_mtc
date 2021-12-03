@extends('adminlte.page')

@section('title', 'ERP')

@section('content')
<style>
    .belum_diterima{
        float: left;
        width: auto;
        padding: 5px;
        margin-top: 5px;
        border: 1px solid #FFE2E5;
        background-color: #FFE2E5;
        color: #F7616B;
        font-size: 14px;
        border-radius: 6px;
    }
    .sudah_diterima{
        float: left;
        width: auto;
        padding: 5px;
        margin-top: 5px;
        border: 1px solid #C9F7F5;
        background-color: #C9F7F5;
        color: #1CC7CD;
        font-size: 14px;
        border-radius: 6px;
    }
    /* .dataTables_filter{
        display: none;
    } */
</style>
<link rel="stylesheet" href="{{ asset('vendor/fullcalendar/main.css') }}">
<script src="{{ asset('vendor/fullcalendar/main.js') }}"></script>
<input type="hidden" name="" id="auth" value="{{ Auth::user()->divisi_id }}">
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transfer Gudang</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="row ml-2">
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Filter Tanggal</label>
            <select name="" id="filter_tgl" class="form-control">
                <option value="tgl_mulai">Tanggal Mulai</option>
                <option value="tgl_selesai">Tanggal Selesai</option>
            </select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <label for="">Tanggal</label>
            <input type="text" name="" id="datetimepicker1" class="form-control">
        </div>
    </div>
</div>
<div class="row ml-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table_produk_perakitan ">
                            <thead class="thead-dark">
                                {{-- <tr>
                                    <th colspan="2" class="text-center">Tanggal</th>
                                    <th rowspan="2">Nomor BPPB</th>
                                    <th rowspan="2">Produk</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Status</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th class="text-center">Tgl Mulai</th>
                                    <th class="text-center">Tgl Selesai</th>
                                </tr> --}}
                                <tr>
                                    <th class="text-center">Tanggal Masuk</th>
                                    <th class="text-center">Tanggal Keluar</th>
                                    <th>Nomor BPPB</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modalRakit" id="" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm">
                                <label for="">Nomor BPPB</label>
                                    <div class="card" style="background-color: #C8E1A7">
                                        <div class="card-body">
                                            <span id="no_bppb">89798797856456</span>
                                        </div>
                                      </div>
                            </div>
                            <div class="col-sm">
                                <label for="">Nama Produk</label>
                                <div class="card" style="background-color: #F89F81">
                                    <div class="card-body">
                                        <span id="produk">Produk 1</span>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-sm">
                                <label for="">Kategori</label>
                                <div class="card" style="background-color: #FCF9C4">
                                    <div class="card-body">
                                        <span id="kategori">Kategori 1</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="">Jumlah Rakit</label>
                                <div class="card" style="background-color: #FFCC83">
                                    <div class="card-body">
                                        <span id="jml">100 Unit</span>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-sm">
                                <label for="">Tanggal Mulai</label>
                                <div class="card" style="background-color: #FFE0B4">
                                    <div class="card-body">
                                        <span id="start">10-06-2021</span>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-sm">
                                <label for="">Tanggal Selesai</label>
                                <div class="card" style="background-color: #FFECB2">
                                    <div class="card-body">
                                       <span id="end"> 13-06-2021</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="post" id="form-scan">
                                <table class="table table-striped scan-produk" id>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="" id="head-cb"></th>
                                            <th>Nomor Seri</th>
                                        </tr>
                                    </thead>
                                    <tbody class="scan"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="">Simpan</button>
            </div>
        </form>
        </div>
    </div>
</div>
@stop

@section('adminlte_js')
<script>
    var start_date;
    var end_date;
    var DateFilterFunction = (function (oSettings, aData, iDataIndex) {
        var dateStart = parseDateValue(start_date);
        var dateEnd = parseDateValue(end_date);

        var evalDate = parseDateValue(aData[0]);
        if ((isNaN(dateStart) && isNaN(dateEnd)) ||
            (isNaN(dateStart) && evalDate <= dateEnd) ||
            (dateStart <= evalDate && isNaN(dateEnd)) ||
            (dateStart <= evalDate && evalDate <= dateEnd)) {
            return true;
        }
        return false;
    });

    function parseDateValue(rawDate) {
        var dateArray = rawDate.split("-");
        var parsedDate = new Date(dateArray[2], parseInt(dateArray[1]) - 1, dateArray[
        0]);
        return parsedDate;
    }
   $(document).ready(function () {
    var $dTable = $('.table_produk_perakitan').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/api/prd/kirim",
        columns: [
            {data: "start"},
            {data: "end"},
            {data: "no_bppb"},
            {data: "produk"},
            {data: "jml"},
            {data: "status"},
            {data: "action"},   
        ],
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json"
            },
        "lengthChange": false,
        "columnDefs": [
        {
            "targets": [6],
            "visible": document.getElementById('auth').value == '2' ? false : true
        }]
    });

    $('#datetimepicker1').daterangepicker({
            autoUpdateInput: false
        });

        $('#datetimepicker1').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format(
                'DD-MM-YYYY'));
            start_date = picker.startDate.format('DD-MM-YYYY');
            end_date = picker.endDate.format('DD-MM-YYYY');
            $.fn.dataTableExt.afnFiltering.push(DateFilterFunction);
            $dTable.draw();
        });

        $('#datetimepicker1').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
            start_date = '';
            end_date = '';
            $.fn.dataTable.ext.search.splice($.fn.dataTable.ext.search.indexOf(DateFilterFunction, 1));
            $dTable.draw();
        });


    function modalRakit() {
        $('.modalRakit').modal('show');
        $("#head-cb").on('click', function () {
            var isChecked = $("#head-cb").prop('checked')
            $('.cb-child').prop('checked', isChecked)
        });
    }
    function transfer() {
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Data yang sudah di transfer tidak dapat diubah!",
            icon: "warning",
            buttons: true,
            showCancelButton: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                Swal.fire(
                    'Berhasil!',
                    'Data berhasil di transfer!',
                    'success'
                );
                $('.modalRakit').modal('hide');
            } else {
                Swal.fire(
                    'Batal!',
                    'Data tidak berhasil di transfer!',
                    'error'
                );
            }
        });
    }
    var id = '';
    var prd = '';
    var jml = '';
    $(document).on('click', '.detailmodal', function() {
        id = $(this).data('id');
        prd = $(this).data('prd');
        jumlah = $(this).data('jml');

        $.ajax({
            url: "/api/prd/headerSeri/" + id,
            type: "get",
            dataType: "json",
            success: function(res) {
                // console.log(res);
                $('span#no_bppb').text(res.bppb);
                $('span#produk').text(res.produk);
                $('span#kategori').text(res.kategori);
                $('span#jml').text(res.jumlah);
                $('span#start').text(res.start);
                $('span#end').text(res.end);
            }
        })

        var table = $('.scan-produk').DataTable({
            destroy: true,
            ordering: false,
            "autoWidth": false,
            processing: true,
            "lengthChange": false,
            ajax: "/api/prd/detailSeri1/" + prd,
            columns: [
                {data: "no_seri"},
                {data: "no_seri"}
            ],
            columnDefs: [
                {
                    targets: [0],
                    checkboxes: {
                        selectRow: true,
                    },
                    width: "5%"
                },
            ],
            select : {
                style: 'multi'
            },
        });
        $('#form-scan').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);

        var rows_selected = table.column(0).checkboxes.selected();
        const seri = [];

        $.each(rows_selected, function (index, rowId) { 
            seri.push(rowId);
       });
       $.ajax({
            url: "/api/prd/send",
            type: "post",
            data: {
                "_token" : "{{csrf_token() }}",
                qty: jumlah,
                gbj_id : prd,
                jadwal_id : id,
                noseri: seri,
            },
            success: function(res) {
                // console.log(res);
            }
        })
    });
        modalRakit();
    });
    
   });
</script>
@stop
