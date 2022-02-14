<?= $this->extend('Layouts\dashboard') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="purple">
                <i class="material-icons">assignment</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Data Pelanggan</h4>
                <div class="toolbar">
                    <!-- Here you can write extra buttons/actions for the toolbar -->
                    <a href="<?= base_url($url . "/new") ?>" class="btn btn-primary btn-icon"><i class="material-icons">add</i></a>
                </div>
                <div class="material-datatables">
                    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>BTS</th>
                                <th>IP</th>
                                <th>Status</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>BTS</th>
                                <th>IP</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($pelanggan as $item) : ?>
                                <tr id="<?= $item["id_pelanggan"] ?>">
                                    <td><?= $item["id_pelanggan"] ?></td>
                                    <td><?= $item["nama_depan"] ?></td>
                                    <td><?= $item["nama_email"] ?></td>
                                    <td><?= $item["koneksi"] ?></td>
                                    <td><?= $item["ip_address"] ?></td>
                                    <td><?= $item["is_aktif"] ?></td>
                                    <td class="text-right">
                                        <a href="<?= base_url($url . "/edit" . "/" . $item["id_pelanggan"]) ?>" class="btn btn-simple btn-warning btn-icon edit"><i class="material-icons">dvr</i></a>
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
            let id_pelanggan = $tr.attr("id");
            let url = "<?= esc(base_url('web/pelanggan/data/delete'), 'js') ?>" + "/" + id_pelanggan;
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
                        id_pelanggan: id_pelanggan,
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