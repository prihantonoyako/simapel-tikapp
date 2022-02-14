<?= $this->extend('Layouts\dashboard') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?= base_url($url_action) ?>" method="POST">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Register Forms</h4>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Email Address
                                <small>*</small>
                            </label>
                            <input class="form-control" name="nama_email" type="email"/>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Nama Depan
                                <small>*</small>
                            </label>
                            <input class="form-control" name="nama_depan" type="text"/>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Nama Belakang
                                <small>*</small>
                            </label>
                            <input class="form-control" name="nama_belakang" type="text"/>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">
                                Alamat IP
                                <small>*</small>
                            </label>
                            <input class="form-control" name="ip_address" type="text"/>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Lokasi <small>(required)</small></label>
                            <select name="lokasi" class="form-control">
                                <option value="null" selected>Belum Ada</option>
                                <?php foreach ($lokasi as $item) : ?>
                                    <option value="<?= $item->id_lokasi ?>"><?= $item->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group label-floating">
                            <select name="koneksi" class="form-control">
                                <option disabled selected>Pilih koneksi</option>
                                <?php foreach ($bts as $item) : ?>
                                    <option value="<?= $item->id_bts ?>"><?= $item->ssid ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-footer text-right">
                            <button type="submit" class="btn btn-rose btn-fill">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>