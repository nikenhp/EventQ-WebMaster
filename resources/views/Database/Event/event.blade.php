@extends('adminlte::page')

@section('title', 'Eventq - Event Database')

@section('content')
    <div class="content">
        <section class="content-header">
            <h1>
                Event<br>
                <small style="padding-left: 0">Registered Event</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= url('dashboard')?>">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> Event
                    </a>
                </li>
            </ol>
        </section>

        <section class="content container-fluid main-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Event</b></h3>
                        </div>
                        <div class="box-body" style="padding: 10px 30px">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ url('/event/add') }}" class="btn btn-primary">Add an Event</a>
                                </div>
                            </div>
                            <br>
                            <!-- <hr style="border-style: dashed; border-width: 0.8px; border-color: gray"> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-bordered table-striped table-hover" id="laporanEvent" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td width="50">No.</td>
                                            <td>Nama Event</td>
                                            <td>Address</td>
                                            <td>Harga</td>
                                            <td>Kuota</td>
                                            <td>Tanggal Mulai</td>
                                            <td>Tanggal Akhir</td>
                                            <td>Deskripsi Acara</td>
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

@stop

@section('js')
    <script type="text/javascript">

        var FormData;

        $(document).ready(function() {
            var tableLaporan = $('#laporanEvent').DataTable({
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
                    "url": "<?= url('/event/data_table')?>",
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
                        "data": "name",
                        width: 90,
                        "orderable": true,
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [2],
                        "data": "address"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [3],
                        "data": "price"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [4],
                        "data": "quota"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [5],
                        "data": "start_date"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [6],
                        "data": "end_date"
                    },
                    {
                        class: "text-center",
                        "orderable": false,
                        "targets": [7],
                        "data": "description"
                    },
                    {
                        targets: [8],
                        "sortable": false,
                        "searchable": false,
                        render: function(data, type, row, meta){
                            return "<div class='btn-group'>"+
                                "<a href='{{url("/event/edit")}}/"+row["id"]+"' class='btn btn-primary'>Edit</a>"+
                                "<a href='{{url("/event/delete")}}/"+row["id"]+"' class='btn btn-danger'>Hapus</a>"+
                                "</div>";
                        }
                    }
                ],
            });

            tableLaporan.draw();
        });

    </script>


@stop
