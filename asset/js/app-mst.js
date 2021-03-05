var appcustomer = new Vue({
    el: '#addcust',
    data: {
        kodecust: '',
        namacust: '',
        telpcust: '',
    },
    methods: {
        tambahCust: function () {
            axios.post('http://localhost/tes-mst/transaksi/prosescustomerbaru', {
                kodecust: this.kodecust,
                namacust: this.namacust,
                telpcust: this.telpcust
            })
            .then(function(){
                appcustomer.kodecust = '';
                appcustomer.namacust = '';
                appcustomer.telpcust = '';
                console.log('berhasil');
            });
        }
    },
    created: function () {
        
    }
});

var appbarang = new Vue({
    el: '#addbarang',
    data: {
        kodebarang: '',
        namabarang: '',
        hargabarang: '',
    },
    methods: {
        tambahBrg: function () {
            axios.post('http://localhost/tes-mst/transaksi/prosesbarangbaru', {
                kodebarang: this.kodebarang,
                namabarang: this.namabarang,
                hargabarang: this.hargabarang
            })
            .then(function(){
                appcustomer.kodebarang = '';
                appcustomer.namabarang = '';
                appcustomer.hargabarang = '';
                console.log('berhasil');
            });
        }
    },
    created: function () {
        
    }
});
