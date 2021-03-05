<?php 
    class M_transaksi extends CI_Model {
        public function fetch_transaksi(){
            $query = $this->db->query('select t_sales.kode, tgl, name, sum(qty) as totalbrg, subtotal, diskon_nilai, ongkir, total_bayar from t_sales inner join t_sales_det on t_sales.kode = t_sales_det.no_transaksi inner join m_customer on t_sales.cust_id = m_customer.id group by t_sales.kode');

            return $query->result();
        }

        public function get_no_trx(){
            $query = $this->db->query('select kode from t_sales order by id desc limit 1');
            return $query->result();
        }

        public function fetch_customer(){
            $query = $this->db->get('m_customer');
            return $query->result();
        }

        public function fetch_barang(){
            $query = $this->db->get('m_barang');
            return $query->result();
        }
    }
?>