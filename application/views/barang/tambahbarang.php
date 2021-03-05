<?php $this->load->view('head-trx'); ?>

<div id="addbarang" class="container-fluid">
    <div class="row">
        <div class="col-12"><h2>Tambah Barang</h2></div>
    </div>
    <div class="row">
        <div class="col-8">
            <form>
                <div class="form-group row">
                    <label for="kodebarang" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input v-model="kodebarang" type="text" class="form-control" id="kodebarang" name="kodebarang" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input v-model="namabarang" type="text" class="form-control" id="namabarang" name="namabarang">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargabarang" class="col-sm-2 col-form-label">Harga Barang</label>
                    <div class="col-sm-10">
                        <input v-model="hargabarang" type="text" class="form-control" id="hargabarang" name="hargabarang">
                    </div>
                </div>
            </form>

            <button class="btn btn-primary" id="btnsimpanbarang" @click="tambahBrg()">Simpan Barang</button>
            <a class="btn btn-danger" id="btnsimpanbarang" href="<?= site_url() ?>">Batal</a>
        </div>
    </div>
</div>

<?php $this->load->view('foot-trx'); ?>