<?php $this->load->view('head-trx'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Aplikasi Transaksi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="<?= site_url(); ?>transaksi/inputitembarang"><i class="fa fa-plus"></i> Tambah Barang</a>
                <a class="btn btn-primary" href="<?= site_url() ?>transaksi/inputcustomer"><i class="fa fa-plus"></i> Tambah Customer</a>
                <a class="btn btn-primary" href="<?= site_url(); ?>transaksi/tambahtrx"><i class="fa fa-plus"></i> Tambah Transaksi</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Daftar Transaksi</h3>
            </div>
            <div class="col-12">
                <div id="list-trx">
                    <table id="tblbarang" class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No Transaksi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Ongkir</th>
                                <th scope="col">Total</th>                  
                            </tr>
                        </thead>
                        <tbody id="body-trx">
                            <?php 
                                $no = 1;
                                foreach ($list_trx as $key) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $key->kode; ?></td>
                                    <td><?= $key->tgl; ?></td>
                                    <td><?= $key->name; ?></td>
                                    <td><?= $key->totalbrg; ?></td>
                                    <td><?= $key->subtotal; ?></td>
                                    <td><?= $key->diskon_nilai; ?></td>
                                    <td><?= $key->ongkir; ?></td>
                                    <td><?= $key->total_bayar; ?></td>
                                </tr>
                            <?php
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('foot-trx'); ?>
    
    