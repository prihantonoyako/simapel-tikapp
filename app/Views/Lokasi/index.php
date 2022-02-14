<?= $this->extend("Layouts/dashboard") ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">place</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data Lokasi</h4>
                <div class="toolbar">
                    <a href="<?= base_url($url . "/new") ?>" class="btn btn-primary btn-icon">
                        <i class="material-icons">add_location_alt</i> Tambah Lokasi
                    </a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kota</th>
                                <th>Keterangan</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Kota</th>
                                <th>Keterangan</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($lokasi as $item): ?>
                                <tr id="<?= $item->id_lokasi ?>">
                                <td><?= $item->nama ?></td>
                                <td><?= $item->kota ?></td>
                                <td><?= $item->keterangan ?></td>
                                <td class="text-right">
                                    <!-- <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="material-icons">favorite</i></a> -->
                                    <a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>
                                    <a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="material-icons">close</i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }

        });

        var table = $('#datatables').DataTable();
        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            let id_lokasi = $tr.attr("id");
            let url = "<?= esc($url, 'js') ?>" + "/delete/" + id_lokasi;
            console.log(url);
            swal({
                title: 'Apakah anda yakin?',
                text: "Data akan dihapus secara permanen!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Yes, delete it!',
                buttonsStyling: false
            }).then(function() {
                $.ajax({
                    url: url,
                    accepts: {
                        json: 'application/json'
                    },
                    type: "POST",
                    dataType: 'json',
                    data: {
                        id_lokasi: id_lokasi,
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function(result) {
                        table.row($tr).remove().draw();
                        swal({
                            title: 'Deleted!',
                            text: result.status,
                            type: 'success',
                            confirmButtonClass: "btn btn-success",
                            buttonsStyling: false
                        })
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: "Oops!",
                            text: jqXHR.responseText,
                            icon: "error",
                            timer: 5000
                        });
                    }
                });
            });
            e.preventDefault();
        });

        //Like record
        // table.on('click', '.like', function() {
        //     alert('You clicked on Like button');
        // });

        $('.card .material-datatables label').addClass('form-group');
    });
</script>
<?= $this->endsection() ?>