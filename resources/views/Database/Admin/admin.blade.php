@extends('adminlte::page')

@section('title', 'Eventq - Adminstrator Database')

@section('content')
    <div class="content">
        <section class="content-header">
            <h1>
                Administrator<br>
                <small style="padding-left: 0">Registered Administrator</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= url('dashboard')?>">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> Adminstrator
                    </a>
                </li>
            </ol>
        </section>

        <section class="content container-fluid main-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Menu</b></h3>
                        </div>
                        <div class="box-body" style="padding: 10px 30px">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('/database/menu/add') }}" class="btn btn-primary">Tambah menu</a>
                                </div>
                            </div>
                            <br>
                            <!-- <hr style="border-style: dashed; border-width: 0.8px; border-color: gray"> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-bordered table-striped table-hover" id="admindt" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td width="50">No.</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Gender</td>
                                            <td>Alamat</td>
                                            <td>Kota</td>
                                            <td></td>
                                            <td>Aksi</td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script type="text/javascript">

        var FormData;

        $(document).ready(function() {
            var tableDt = $('#admindt').DataTable({
                "sDom":"ltipr",
                "lengthMenu": [[10, 30, 100, 200, -1], [10, 30, 100, 200, "All"]],
                "scrollX": true,
                "scrollY": true,
                "language": {
                    "lengthMenu": "Tampil _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Data kosong",
                    "infoFiltered": "(difilter dari total _MAX_ data)",
                    "search": "Cari :",
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= url('/database/menu/get_datatable')?>",
                    "type": "GET",
                },
                "columnDefs": [
                    {
                        class: "text-center",
                        width: 30,
                        "targets": [0],
                        "orderable": false,
                        render: function(data, type, row, meta){
                            return meta.row+meta.settings._iDisplayStart+1
                        }
                    },
                    {
                        "targets": [1],
                        "data": "nama_menu",
                        width: 90,
                        "orderable": true,
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [2],
                        "data": "harga"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [3],
                        render: function (data, type, row, meta){
                            return "<img style='width:100%' src='{{ asset('images/barang') }}/"+row['gambar']+"'>"
                        }
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [4],
                        "data": "deskripsi"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [5],
                        "data": "category"
                    },
                    {
                        targets: [6],
                        "sortable": false,
                        "searchable": false,
                        render: function(data, type, row, meta){
                            return "<div class='btn-group'>"+
                                "<a href='/database/menu/edit/"+row['id']+"' class='btn btn-primary'>Edit</a>"+
                                "<a href='/database/menu/delete/"+row['id']+"' class='btn btn-danger'>Hapus</a>"+
                                "</div>";
                        }
                    }
                ],
            });

            tableLaporan.draw();
        });

    </script>




@stop
