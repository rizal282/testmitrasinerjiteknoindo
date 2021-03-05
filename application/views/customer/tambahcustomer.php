<?php $this->load->view('head-trx'); ?>

<div id="addcust" class="container-fluid">
    <div class="row">
        <div class="col-12"><h2>Tambah Customer</h2></div>
    </div>
    <div class="row">
        <div class="col-8">
            <form>
                <div class="form-group row">
                    <label for="kodecustomer" class="col-sm-2 col-form-label">Kode Customer</label>
                    <div class="col-sm-10">
                        <input v-model="kodecust" type="text" class="form-control" id="kodecustomer" name="kodecustomer" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namacustomer" class="col-sm-2 col-form-label">Nama Customer</label>
                    <div class="col-sm-10">
                        <input v-model="namacust" type="text" class="form-control" id="namacustomer" name="namacustomer">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telpcustomer" class="col-sm-2 col-form-label">No Telp</label>
                    <div class="col-sm-10">
                        <input v-model="telpcust" type="text" class="form-control" id="telpcustomer" name="telpcustomer">
                    </div>
                </div>
            </form>

            <button class="btn btn-primary" id="btnsimpancust" @click="tambahCust()">Simpan Customer</button>
            <a class="btn btn-danger" href="<?= site_url() ?>">Batal</a>
        </div>
    </div>
</div>

<?php $this->load->view('foot-trx'); ?>