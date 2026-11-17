<style>
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<section class="content">
    <?= $this->session->flashdata('message'); ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="loading-overlay" style="display: none;">
                    <i class="fa fa-spinner fa-spin" style="font-size: 50px;"></i>
                </div>
                <div class="box-header with-border">
                    <a class="btn btn-xs bg-green" href="<?= base_url('fat/tambah') ?>"><span class="fa fa-plus"></span>
                        Add</a>
                    <a class="btn btn-xs bg-green" href="<?= base_url('excel/fat') ?>"><span class="fa fa-print"></span>
                        Print</a>
                    <a class="btn btn-xs bg-green" data-toggle="modal" data-target="#modal-tambah"><span
                            class="fa fa-plus"></span>
                        Excel</a>
                    <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                            <form id="search-form" method="POST" action="<?= base_url('fat/search') ?>">
                                <div class="input-group input-group-sm">
                                    <input type="text" value="<?= $search ?>" name="search"
                                        class="form-control pull-right input-group input-group-sm" placeholder="Search"
                                        id="search-input">
                                    <span class="input-group-btn">
                                        <input class="btn bg-blue btn-flat" type='submit' name='submit'
                                            value='Cari'>Go!</input>
                                    </span>
                                </div>

                            </form>
                            <br>
                            <a class="btn btn-xs bg-yellow pull-right" href="<?= base_url('fat/index') ?>"><span
                                    class="fa fa-refresh"></span>
                                Refresh</a>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example3" class="table table-bordered table-striped dataTable nowrap"
                                    cellspacing="0" role="grid" aria-describedby="example1_info" style="width:100%">
                                    <thead>
                                        <tr role="row">
                                            <th style="width: 10px;" rowspan="">No.</th>
                                            <th style="width: 10px;">ID FAT</th>
                                            <th style="width: 55.1094px;">Port idle</th>
                                            <th style="width: 41.5781px;">Lat - Long</th>
                                            <th style="width: 41.5781px;">Status</th>
                                            <th style="width: 41.5781px;">OLT</th>
                                            <th style="width: 41.5781px;">FDT</th>
                                            <th style="width: 41.5781px;">Timestamp</th>
                                            <th style="width: 41.5781px;">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fat-table-body">
                                        <?php $no = 1;
                                        foreach ($fat as $x) : ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?= $no++; ?></td>
                                                <td class="sorting_1"><?= $x['id_fat'] ?></td>
                                                <td><?= number_format($x['port_idle']) ?></td>
                                                <td><?= $x['lat'] ?>, <br> <?= $x['long'] ?>
                                                </td>
                                                <td><?= $x['status_pembangunan'] ?> </td>
                                                <td><?= $x['olt'] ?></td>
                                                <td><?= $x['id_fdt'] ?></td>
                                                <td><?= $x['penginput'] ?> <br> <?= $x['timestamp'] ?> </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn bg-green btn-social btn-flat btn-xs"
                                                            data-toggle="dropdown"><i class="fa fa-arrow-circle-down"></i>
                                                            Pilih</button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a href="<?= base_url('fat/detail/' . $x['no']); ?>"
                                                                    class="btn btn-social btn-flat btn-block btn-sm"><i
                                                                        class="fa fa-list-ol"></i>Detail</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('fat/edit/' . $x['no']); ?>"
                                                                    class="btn btn-social btn-flat btn-block btn-sm"><i
                                                                        class="fa fa-edit"></i>Ubah</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?= base_url('fat/hapus/' . $x['no']); ?>"
                                                                    class="btn btn-social btn-flat btn-block btn-sm tombol-hapus"><i
                                                                        class="fa fa-trash-o"></i> Hapus</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php if (count($fat) <= 1) { ?>
                                                <tr>
                                                    <td colspan='10'>No record found.</td>
                                                </tr>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pagination-container">
                    <?= $pagination; ?>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <form name="myform" onsubmit="return val()" enctype="multipart/form-data" role="form"
                action="<?= base_url('fat/tambah_brand') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Tambah Brand FAT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="">Brand FAT</label>
                                <input type="text" name="nama_brand" id="" class="form-control input-sm" required>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <form name="myform" onsubmit="return val()" enctype="multipart/form-data" role="form"
                action="<?= base_url('fat/tambah_excel') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Input Excel Cluster</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <label class="">File</label>
                                <input type="file" name="excel" id="" class="form-control input-sm" required>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        function performSearch(url) {
            var searchText = $('#search-input').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    search: searchText,
                    submit: true
                },
                dataType: 'json',
                beforeSend: function() {
                    $('.loading-overlay').show(); // Tampilkan loading
                },
                success: function(data) {
                    updateTable(data.fat);
                    $('#pagination-container').html(data.pagination);
                },
                error: function() {
                    alert('Error performing search');
                },
                complete: function() {
                    $('.loading-overlay').hide(); // Sembunyikan loading
                }
            });
        }

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            performSearch('<?= base_url('fat/search') ?>');
        });

        $(document).on('click', '#pagination-container .pagination li a', function(e) {
            e.preventDefault();
            var href = $(this).attr('href');
            performSearch(href);
        });

        function updateTable(data) {
            var tableBody = $('#fat-table-body');
            tableBody.empty();
            if (data.length > 0) {
                var no = 1;
                $.each(data, function(index, item) {
                    var row = '<tr role="row" class="odd">' +
                        '<td class="sorting_1">' + (no++) + '</td>' +
                        '<td class="sorting_1">' + item.id_fat + '</td>' +
                        '<td>' + (item.port_idle ? Number(item.port_idle).toLocaleString() : '0') + '</td>' +
                        '<td>' + item.lat + ', <br> ' + item.long + '</td>' +
                        '<td>' + item.status_pembangunan + '</td>' +
                        '<td>' + item.olt + '</td>' +
                        '<td>' + item.id_fdt + '</td>' +
                        '<td>' + item.penginput + ' <br> ' + item.timestamp + '</td>' +
                        '<td>' +
                        '<div class="btn-group">' +
                        '<button type="button" class="btn bg-green btn-social btn-flat btn-xs" data-toggle="dropdown"><i class="fa fa-arrow-circle-down"></i> Pilih</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                        '<li><a href="<?= base_url('fat/detail/') ?>' + item.no + '" class="btn btn-social btn-flat btn-block btn-sm"><i class="fa fa-list-ol"></i>Detail</a></li>' +
                        '<li><a href="<?= base_url('fat/edit/') ?>' + item.no + '" class="btn btn-social btn-flat btn-block btn-sm"><i class="fa fa-edit"></i>Ubah</a></li>' +
                        '<li><a href="<?= base_url('fat/hapus/') ?>' + item.no + '" class="btn btn-social btn-flat btn-block btn-sm tombol-hapus"><i class="fa fa-trash-o"></i> Hapus</a></li>' +
                        '</ul>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                    tableBody.append(row);
                });
            } else {
                tableBody.html('<tr><td colspan="9">No record found.</td></tr>');
            }
        }
    });
</script>