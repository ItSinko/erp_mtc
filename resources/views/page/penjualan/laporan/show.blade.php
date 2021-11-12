@extends('adminlte.page')

@section('title', 'ERP')

@section('content_header')
<h1 class="m-0 text-dark">Laporan</h1>
@stop

@section('adminlte_css')
<style>
    .filter {
        margin: 5px;
    }

    .hide {
        display: none !important;
    }

    .table {
        vertical-align: middle;
    }

    .tes {
        background-color: #ffff !important;
    }
</style>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-secondary">
                    <div class="card-title">Pencarian</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- <form method="POST" action="/api/laporan/create"> -->
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label for="" class="col-form-label col-5" style="text-align: right">Distributor / Customer</label>
                                    <div class="col-4">
                                        <select class="select2 select-info form-control customer_id" name="customer_id" id="customer_id">
                                            <option value="semua">Semua Distributor</option>
                                        </select>
                                        <div class="feedback" id="msgcustomer_id">
                                            <small class="text-muted">Distributor / Customer boleh dikosongi</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="penjualan" class="col-form-label col-5" style="text-align: right">Penjualan</label>
                                    <div class="col-5 col-form-label">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penjualan" id="penjualan1" value="semua" />
                                            <label class="form-check-label" for="penjualan1">Semua</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penjualan" id="penjualan2" value="ekatalog" />
                                            <label class="form-check-label" for="penjualan2">E-Catalogue</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penjualan" id="penjualan3" value="spa" />
                                            <label class="form-check-label" for="penjualan3">SPA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penjualan" id="penjualan4" value="spb" />
                                            <label class="form-check-label" for="penjualan4">SPB</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_mulai" class="col-form-label col-5" style="text-align: right">Tanggal Awal</label>
                                    <div class="col-2">
                                        <input type="date" class="form-control col-form-label @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" readonly />
                                        <div class="invalid-feedback" id="msgtanggal_mulai">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_akhir" class="col-form-label col-5" style="text-align: right">Tanggal Akhir</label>
                                    <div class="col-2">
                                        <input type="date" class="form-control col-form-label @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir" name="tanggal_akhir" readonly />
                                        <div class="invalid-feedback" id="msgtanggal_akhir">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-5"></div>
                                    <div class="col-4">
                                        <span class="float-right filter"><button type="button" class="btn btn-success" id="btncetak" disabled>Cetak</button></span>
                                        <span class="float-right filter"><button type="button" class="btn btn-outline-danger" id="btnbatal">Batal</button></span>
                                    </div>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row hide" id="semuaform">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Laporan Penjualan</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="semuatable" style="width:100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No PO</th>
                                    <th>No AKN</th>
                                    <th>Customer / Distributor</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Batas Kontrak</th>
                                    <th>Tanggal PO</th>
                                    <th>Instansi</th>
                                    <th>Satuan</th>
                                    <th>Produk</th>
                                    <th>No Seri</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row hide" id="ekatalogform">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Laporan Penjualan Ekatalog</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="ekatalogtable" style="width: 100%;">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No AKN</th>
                                    <th>No SO</th>
                                    <th>No PO</th>
                                    <th>No SJ</th>
                                    <th>Customer / Distributor</th>
                                    <th>Batas Kontrak</th>
                                    <th>Tanggal Pengiriman</th>
                                    <th>Tanggal PO</th>
                                    <th>Instansi</th>
                                    <th>Satuan</th>
                                    <th>Produk</th>
                                    <th>No Seri</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row hide" id="spaform">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Laporan Penjualan SPA</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="spatable" style="width:100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No PO</th>
                                    <th>No SO</th>
                                    <th>Customer / Distributor</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal PO</th>
                                    <th>Produk</th>
                                    <th>No Seri</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row hide" id="spbform">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Laporan Penjualan SPB</h5>
                    <div class="table-responsive">
                        <table class="table table-hover" id="spbtable" style="width:100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No PO</th>
                                    <th>No SO</th>
                                    <th>Customer / Distributor</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal PO</th>
                                    <th>Produk</th>
                                    <th>No Seri</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')

<script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.bootstrap4.min.css">
<!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js "></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css "></script> -->

<script>
    $(function() {
        $('#customer_id').append('<option value="">s</option>');
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        console.log(today);
        $("#tanggal_mulai").attr("max", today);
        $("#tanggal_akhir").attr("max", today);

        $('#semuatable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: {
                'url': '/api/laporan/penjualan/semua/0/0/0/',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            buttons: [{
                    extend: 'excel',
                    title: 'Laporan Penjualan',
                    text: '<i class="far fa-file-excel"></i> Export',
                    className: "btn btn-info"
                },
                {
                    extend: 'print',
                    title: 'Laporan Penjualan',
                    text: '<i class="fas fa-print"></i> Cetak',
                    className: "btn btn-primary"
                },
            ],
            columns: [{
                    data: 'kosong'
                },
                {
                    data: 'no_paket'
                },
                {
                    data: 'nama_customer'
                },
                {
                    data: 'tgl_kirim'
                },
                {
                    data: 'tgl_kontrak'
                },
                {
                    data: 'tgl_po'
                },
                {
                    data: 'instansi'
                },
                {
                    data: 'satuan'
                },
                {
                    data: 'nama_produk'
                },
                {
                    data: 'no_seri'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'harga',
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'subtotal',
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'log'
                },
            ],
            rowGroup: {
                startRender: function(rows, group) {
                    var i = 0;
                    console.log(group);
                    return $('<tr/>')
                        .append('<td class="tes" colspan="1"><p style="font-weight:50;">' + group + '</td>');
                },
                endRender: function(rows, group) {
                    var totalPenjualan = rows
                        .data()
                        .pluck('subtotal')
                        .reduce(function(a, b) {
                            return a + b * 1;
                        }, 0);
                    totalPenjualan = $.fn.dataTable.render.number(',', '.', 2).display(totalPenjualan);
                    return $('<tr/>')
                        .append('<td colspan="12">Total Penjualan Produk: ' + rows.count() + '</td>')
                        .append('<td colspan="2">' + totalPenjualan + '</td>');
                },
                dataSrc: function(row) {
                    return row.no_po;
                },
            }

        });
        var e = $('#ekatalogtable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: {
                'url': '/api/laporan/penjualan/ekatalog/0/0/0/',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            orderFixed: [
                [1, 'asc']
            ],
            buttons: [{
                    extend: 'excel',
                    title: 'Laporan Penjualan Ekatalog',
                    text: '<i class="far fa-file-excel"></i> Export',
                    className: "btn btn-info"
                },
                {
                    extend: 'print',
                    title: 'Laporan Penjualan Ekatalog',
                    text: '<i class="fas fa-print"></i> Cetak',
                    className: "btn btn-primary"
                },
            ],
            columns: [{
                    data: 'kosong'
                },
                {
                    data: 'so'
                },
                {
                    data: 'no_po'
                },
                {
                    data: 'no_sj'
                },
                {
                    data: 'nama_customer'
                },
                {
                    data: 'tgl_kontrak'
                },
                {
                    data: 'tgl_kirim'
                },
                {
                    data: 'tgl_po'
                },
                {
                    data: 'instansi'
                },
                {
                    data: 'satuan'
                },
                {
                    data: 'nama_produk'
                },
                {
                    data: 'no_seri'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'harga',
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'subtotal',
                    render: $.fn.dataTable.render.number(',', '.', 2),
                },
                {
                    data: 'log'
                }
            ],
            rowGroup: {
                startRender: function(rows, group) {
                    var i = 0;
                    console.log(group);
                    return $('<tr/>')
                        .append('<td class="tes" colspan="1"><p style="font-weight:50;">' + group + '</td>');
                },
                endRender: function(rows, group) {
                    var totalPenjualan = rows
                        .data()
                        .pluck('subtotal')
                        .reduce(function(a, b) {
                            return a + b * 1;
                        }, 0);
                    totalPenjualan = $.fn.dataTable.render.number(',', '.', 2).display(totalPenjualan);
                    return $('<tr/>')
                        .append('<td colspan="14">Total Penjualan Produk: ' + rows.count() + '</td>')
                        .append('<td colspan="2">' + totalPenjualan + '</td>');
                },
                dataSrc: function(row) {
                    return row.no_paket;
                },
            }
        });

        $('#spatable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: {
                'url': '/api/laporan/penjualan/spa/0/0/0/',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            buttons: [{
                    extend: 'excel',
                    title: 'Laporan Penjualan SPA',
                    text: '<i class="far fa-file-excel"></i> Export',
                    className: "btn btn-info"
                },
                {
                    extend: 'print',
                    title: 'Laporan Penjualan SPA',
                    text: '<i class="fas fa-print"></i> Cetak',
                    className: "btn btn-primary"
                },
            ],
            columns: [{
                data: 'kosong'
            }, {
                data: 'so'
            }, {
                data: 'nama_customer'
            }, {
                data: 'tgl_kirim'
            }, {
                data: 'tgl_po'
            }, {
                data: 'nama_produk'
            }, {
                data: 'no_seri'
            }, {
                data: 'jumlah'
            }, {
                data: 'harga',
                render: $.fn.dataTable.render.number(',', '.', 2),
            }, {
                data: 'subtotal',
                render: $.fn.dataTable.render.number(',', '.', 2),
            }, {
                data: 'log'
            }],
            rowGroup: {
                startRender: function(rows, group) {
                    var i = 0;
                    console.log(group);
                    return $('<tr/>')
                        .append('<td class="tes" colspan="1"><p style="font-weight:50;">' + group + '</td>');
                },
                endRender: function(rows, group) {
                    var totalPenjualan = rows
                        .data()
                        .pluck('subtotal')
                        .reduce(function(a, b) {
                            return a + b * 1;
                        }, 0);
                    totalPenjualan = $.fn.dataTable.render.number(',', '.', 2).display(totalPenjualan);
                    return $('<tr/>')
                        .append('<td colspan="9">Total Penjualan Produk: ' + rows.count() + '</td>')
                        .append('<td colspan="2">' + totalPenjualan + '</td>');
                },
                dataSrc: function(row) {
                    return row.no_po;
                },
            }
        });
        $('#spbtable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: {
                'url': '/api/laporan/penjualan/spb/0/0/0/',
                'headers': {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                }
            },
            buttons: [{
                    extend: 'excel',
                    title: 'Laporan Penjualan SPB',
                    text: '<i class="far fa-file-excel"></i> Export',
                    className: "btn btn-info"
                },
                {
                    extend: 'print',
                    title: 'Laporan Penjualan SPB',
                    text: '<i class="fas fa-print"></i> Cetak',
                    className: "btn btn-primary"
                },
            ],
            columns: [{
                data: 'kosong'
            }, {
                data: 'so'
            }, {
                data: 'nama_customer'
            }, {
                data: 'tgl_kirim'
            }, {
                data: 'tgl_po'
            }, {
                data: 'nama_produk'
            }, {
                data: 'no_seri'
            }, {
                data: 'jumlah'
            }, {
                data: 'harga',
                render: $.fn.dataTable.render.number(',', '.', 2),
            }, {
                data: 'subtotal',
                render: $.fn.dataTable.render.number(',', '.', 2),
            }, {
                data: 'log'
            }],
            rowGroup: {
                startRender: function(rows, group) {
                    var i = 0;
                    console.log(group);
                    return $('<tr/>')
                        .append('<td class="tes" colspan="1"><p style="font-weight:50;">' + group + '</td>');
                },
                endRender: function(rows, group) {
                    var totalPenjualan = rows
                        .data()
                        .pluck('subtotal')
                        .reduce(function(a, b) {
                            return a + b * 1;
                        }, 0);
                    totalPenjualan = $.fn.dataTable.render.number(',', '.', 2).display(totalPenjualan);
                    return $('<tr/>')
                        .append('<td colspan="9">Total Penjualan Produk: ' + rows.count() + '</td>')
                        .append('<td colspan="2">' + totalPenjualan + '</td>');
                },
                dataSrc: function(row) {
                    return row.no_po;
                },
            }
        });

        $('.customer_id').on('keyup change', function() {
            if ($(this).val() != "") {
                $('input[type="radio"][name="penjualan"]').removeAttr('disabled');
                if ($('input[type="radio"][name="penjualan"]').val() != undefined && $('#tanggal_mulai').val() != "" && $('#tanggal_akhir').val() != "") {
                    $("#btncetak").removeAttr('disabled');
                } else {
                    $("#btncetak").attr('disabled', true);
                }
            } else {
                $("#btncetak").attr('disabled', true);
            }
        });

        $('input[type="radio"][name="penjualan"]').on('change', function() {
            if ($(this).val() != "") {
                $('#tanggal_mulai').removeAttr('readonly');
                if ($('#tanggal_mulai').val() != "" && $('#tanggal_akhir').val() != "") {
                    $("#btncetak").removeAttr('disabled');
                } else {
                    $("#btncetak").attr('disabled', true);
                }
            } else {
                $("#btncetak").attr('disabled', true);
            }
        });

        $('#tanggal_mulai').on('keyup change', function() {
            $("#tanggal_akhir").val("");
            $("#btncetak").removeAttr('disabled');
            if ($(this).val() != "") {
                $('#tanggal_akhir').removeAttr('readonly');
                $("#tanggal_akhir").attr("min", $(this).val())
                if ($('input[type="radio"][name="penjualan"]').val() != undefined && $('#tanggal_akhir').val() != "") {
                    $("#btncetak").removeAttr('disabled');
                } else {

                    $("#btncetak").attr('disabled', true);
                }
            } else {
                $("#tanggal_akhir").val("");
                $("#btncetak").attr('disabled', true);
            }
        });

        $('#tanggal_akhir').on('keyup change', function() {
            if ($(this).val() != "") {
                if ($('#tanggal_mulai').val() != "" && $('input[type="radio"][name="penjualan"]').val() != undefined) {
                    $("#btncetak").removeAttr('disabled');
                } else {
                    $("#btncetak").attr('disabled', true);
                }
            } else {
                $("#btncetak").attr('disabled', true);
            }
        });

        $('.customer_id').select2({
            allowClear: false,
            placeholder: 'Pilih Data',
            ajax: {
                tags: [],
                dataType: 'json',
                delay: 250,
                type: 'GET',
                url: '/api/customer/select/',
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.nama
                            };
                        })
                    };
                },
            }
        });

        $("#btnbatal").on('click', function() {
            $("#btncetak").attr('disabled', true);
            $(".customer_id").val('semua').trigger("change");
            $('input[type="radio"][name="penjualan"]').prop('checked', false);
            $('#tanggal_mulai').val('');
            $('#tanggal_mulai').attr('readonly', true);
            $('#tanggal_akhir').val('');
            $('#tanggal_akhir').attr('readonly', true);
            $('#semuaform').addClass('hide');
            $('#ekatalogform').addClass('hide');
            $('#spaform').addClass('hide');
            $('#spbform').addClass('hide');
        });

        $('#btncetak').on('click', function() {
            if ($('input[type="radio"][name="penjualan"]:checked').val() == "semua") {
                var customer_id = $('#customer_id').val();
                var tanggal_mulai = $('#tanggal_mulai').val();
                var tanggal_akhir = $('#tanggal_akhir').val();
                $('#semuatable').DataTable().ajax.url('/api/laporan/penjualan/semua/' + customer_id + '/' + tanggal_mulai + '/' + tanggal_akhir + '').load();
                $('#semuaform').removeClass('hide');
                $('#ekatalogform').addClass('hide');
                $('#spaform').addClass('hide');
                $('#spbform').addClass('hide');
            } else if ($('input[type="radio"][name="penjualan"]:checked').val() == "ekatalog") {
                var customer_id = $('#customer_id').val();
                var tanggal_mulai = $('#tanggal_mulai').val();
                var tanggal_akhir = $('#tanggal_akhir').val();
                $('#ekatalogtable').DataTable().ajax.url('/api/laporan/penjualan/ekatalog/' + customer_id + '/' + tanggal_mulai + '/' + tanggal_akhir + '').load();
                $('#semuaform').addClass('hide');
                $('#ekatalogform').removeClass('hide');
                $('#spaform').addClass('hide');
                $('#spbform').addClass('hide');
            } else if ($('input[type="radio"][name="penjualan"]:checked').val() == "spa") {
                var customer_id = $('#customer_id').val();
                var tanggal_mulai = $('#tanggal_mulai').val();
                var tanggal_akhir = $('#tanggal_akhir').val();
                $('#spatable').DataTable().ajax.url('/api/laporan/penjualan/spa/' + customer_id + '/' + tanggal_mulai + '/' + tanggal_akhir + '').load();
                $('#semuaform').addClass('hide');
                $('#ekatalogform').addClass('hide');
                $('#spaform').removeClass('hide');
                $('#spbform').addClass('hide');
            } else if ($('input[type="radio"][name="penjualan"]:checked').val() == "spb") {
                var customer_id = $('#customer_id').val();
                var tanggal_mulai = $('#tanggal_mulai').val();
                var tanggal_akhir = $('#tanggal_akhir').val();
                $('#spbtable').DataTable().ajax.url('/api/laporan/penjualan/spb/' + customer_id + '/' + tanggal_mulai + '/' + tanggal_akhir + '').load();
                $('#semuaform').addClass('hide');
                $('#ekatalogform').addClass('hide');
                $('#spaform').addClass('hide');
                $('#spbform').removeClass('hide');
            }
        })
    });
</script>
@endsection