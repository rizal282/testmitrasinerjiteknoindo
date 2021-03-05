<?php 
    class Transaksi extends CI_Controller{

        public function index(){
            $data['list_trx'] = $this->M_transaksi->fetch_transaksi();
            $this->load->view('home-trx', $data);
        }

        // page tambah barang baru
        public function inputitembarang(){
            $this->load->view('barang/tambahbarang');
        }

        // page tambah customer baru
        public function inputcustomer(){
            $this->load->view('customer/tambahcustomer');
        }

        // proses tambah customer baru
        public function prosescustomerbaru(){
            $data = json_decode(file_get_contents("php://input"));

            $datacustomer = array(
                'kode' => $data->kodecust,
                'name' => $data->namacust,
                'telp' => $data->telpcust
            );

            $this->db->insert('m_customer', $datacustomer);
        }

        // proses tambah barang baru
        public function prosesbarangbaru(){
            $data = json_decode(file_get_contents("php://input"));

            $databarang = array(
                'kode' => $data->kodebarang,
                'nama' => $data->namabarang,
                'harga' => $data->hargabarang
            );

            $this->db->insert('m_barang', $databarang);
        }

        // ambil daftar transaksi dan tampilkan di home
        // public function fetch_transaksi(){
        //     $arrTrx = array();

        //     $list_trx = $this->M_transaksi->fetch_transaksi();

        //     foreach($list_trx as $key){
        //         $arrTrx[] = $key;
        //     }

        //     echo json_encode($arrTrx);
        // }

        // ambil daftar customer dan tampilkan di dropdown pilih customer
        public function fetch_data_customer(){
            $kode = $this->input->post('kode');

            $arrcust = array();

            $query = $this->db->query('select * from m_customer where kode = "'.$kode.'"')->result();
            foreach($query as $key){
                $arrcust[] = $key;
            }

            echo json_encode($arrcust);
        }

        // ambil data harga barang ketika pilih barang sesuai id barang dan tampilkan di field harga
        public function get_hrg_barang(){
            $arrhrgbarang = array();
            $id = $this->input->post('idbarang');

            $this->db->select('*');
            $this->db->where('id', $id);

            $result = $this->db->get('m_barang')->result();

            foreach($result as $key){
                $arrhrgbarang[] = $key;
            }

            echo json_encode($arrhrgbarang);
        }

        // menambahkan item transaksi
        public function prosestambahtrx(){
            $inputNo = $this->input->post('inputNo');
            $namabarang = $this->input->post('namabarang');
            $hrgbarang = $this->input->post('hrgbarang');
            $qtybarang = $this->input->post('qtybarang');
            $diskonpct = $this->input->post('diskonpct');
            $diskonrp = $this->input->post('diskonrp');
            $hrgdiskon = $this->input->post('hrgdiskon');
            $total = $this->input->post('total');
   
            $datatsalesdet  = array(
                'no_transaksi' => $inputNo,
                'barang_id' => $namabarang,
                'harga_bandrol' => $hrgbarang,
                'qty' => $qtybarang,
                'diskon_pct' => $diskonpct,
                'diskon_nilai' => $diskonrp,
                'harga_diskon' => $hrgdiskon,
                'total' =>  $total,
            );

            $this->db->insert('t_sales_det', $datatsalesdet);

        }

        // menampilkan data item barang yang telah ditambahkan ketika transaksi baru
        public function get_tambah_barang(){
            $notrx = $this->input->post('notrx');

            $arrtambahbrg = array();

            $listtambahbrg = $this->db->query('select * from t_sales_det inner join m_barang on t_sales_det.barang_id = m_barang.id where t_sales_det.no_transaksi = "'.$notrx.'"')->result();

            foreach($listtambahbrg as $key){
                $arrtambahbrg[] = $key;
            }

            echo json_encode($arrtambahbrg);
        }

        // menjumlahkan subtotal harga item barang
        public function total_tambah_barang(){
            $notrx = $this->input->post('notrx');

            $arrsubtotal = array();

            $subtotal = $this->db->query('select sum(total) as subtotal from t_sales_det where no_transaksi = "'.$notrx.'"')->result();

            foreach($subtotal as $key){
                $arrsubtotal[] = $key;
            }

            echo json_encode($arrsubtotal);
        }

        // page tambah transaksi
        public function tambahtrx(){
            $data['notrx'] = $this->M_transaksi->get_no_trx();
            $data['listcust'] = $this->M_transaksi->fetch_customer();
            $data['listbarang'] = $this->M_transaksi->fetch_barang();
            $this->load->view('transaksi/tambahtrx', $data);
        }

        // menambahkan data customer di transaksi baru
        public function tambah_trx_customer(){
            $kode = $this->input->post('kode');
            $tgl = $this->input->post('tgl');
            $cust_id = $this->input->post('cust_id');
            $subtotal = $this->input->post('subtotal');
            $diskon = $this->input->post('diskon');
            $ongkir = $this->input->post('ongkir');
            $total_bayar = $this->input->post('total_bayar');

            $data = array(
                'kode' => $kode,
                'tgl' => date('Y-m-d H:i:s', strtotime($tgl)),
                'cust_id' => $cust_id,
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'ongkir' => $ongkir,
                'total_bayar' => $total_bayar,
            );

            $this->db->insert('t_sales', $data);
        }

    }
?>