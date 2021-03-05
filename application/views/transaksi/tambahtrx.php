<?php $this->load->view('head-trx') ?>

<div id="boxaddtrx" class="container-fluid">
    <div class="row">
        <div class="col-6">
            <legend>Transaksi</legend>

            <?php
                if(count($notrx) == 0){
                    $trx = date('Ym')."-0001";
                }else{
                    foreach ($notrx as $key) {
                       $splittrx = explode('-', $key->kode);
                       $newtrx = $splittrx[1] + 1;
                       $trx = date('Ym')."-000".$newtrx;
                    }
                }
            ?>

            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">No</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNo" name="no" value="<?= $trx; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" class="form-control" id="inputTgl" name="tanggal">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <legend>Customer</legend>
        </div>
        <div class="col-6">
            <form>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Kode</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="inputIdCust" name="idcust" >
                        <input type="text" class="form-control" id="inputKode" name="kode" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputNama" name="nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Telp</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputTelp" name="telp">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Pilih
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <button class="btn btn-success" id="pilihbarang" data-toggle="modal" data-target="#exampleModalBarang">Tambah Barang</button>
            <p></p>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Tambah</th>
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga Bandrol</th>
                        <th scope="col">Diskon (%)</th>
                        <th scope="col">Diskon (Rp)</th>
                        <th scope="col">Harga Diskon</th>   
                        <th scope="col">Total</th>                     
                    </tr>
                </thead>
                <tbody id="listtambahbarang"></tbody>
            </table>
        </div>
        <div class="col-12">
                <div class="row">
                    <div class="col-10" style="text-align: right;">Sub total</div>
                    <div class="col-2"><p id="textsubtotal" style="margin-bottom: 10px;"></p></div>
                </div>
                <div class="row">
                    <div class="col-10" style="text-align: right;">Diskon</div>
                    <div class="col-2"><input style="margin-bottom: 10px;" type="text" name="diskonafter" id="diskonafter" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-10" style="text-align: right;">Ongkir</div>
                    <div class="col-2"><input style="margin-bottom: 10px;" type="text" name="ongkir" id="ongkir" class="form-control"></div>
                </div>
                <div class="row">
                    <div class="col-10" style="text-align: right;">Total Bayar</div>
                    <div class="col-2"><p id="texttotalbayar"></p></div>
                </div>
        </div>
        <div class="col-12" style="text-align: right;">
            <button class="btn btn-success" id="simpancusttrx">Simpan</button>
            <a class="btn btn-danger" href="<?= site_url(); ?>">Batal</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Pilih Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Customer</label>
                    <div class="col-sm-8">
                        <select name="kodecustomer" id="kodecustomer" class="form-control">
                            <?php
                                foreach($listcust as $key){
                            ?>
                                    <option value="<?= $key->kode; ?>"><?= $key->name; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="pilihkode" data-dismiss="modal">Pilih</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambahkan Barang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-8">
                        <input type="hidden" name="kodebarang" id="kodebarang" >
                        <input type="hidden" name="hidenamabarang" id="hidenamabarang" >
                        <select name="namabarang" id="namabarang" class="form-control">
                            <option>Pilih :</option>
                            <?php
                                foreach($listbarang as $key){
                            ?>
                                <option value="<?= $key->id; ?>"><?= $key->kode; ?> - <?= $key->nama; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Harga Barang</label>
                    <div class="col-sm-8">
                        <input type="text" name="hrgbarang" id="hrgbarang" class="form-control" value="" readonly>  
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Qty Barang</label>
                    <div class="col-sm-8">
                        <input type="text" name="qtybarang" id="qtybarang" class="form-control" >  
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Diskon %</label>
                    <div class="col-sm-8">
                        <input type="text" name="diskonpct" id="diskonpct" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Diskon Rp</label>
                    <div class="col-sm-8">
                        <input type="text" name="diskonrp" id="diskonrp" class="form-control" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Harga Diskon</label>
                    <div class="col-sm-8">
                        <input type="text" name="hrgdiskon" id="hrgdiskon" class="form-control" value="" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Total</label>
                    <div class="col-sm-8">
                        <input type="text" name="total" id="total" class="form-control" value="" readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="tambahbarang" data-dismiss="modal">Tambah</button>
        </div>
        </div>
    </div>
    </div>
</div>

<?php $this->load->view('foot-trx') ?>