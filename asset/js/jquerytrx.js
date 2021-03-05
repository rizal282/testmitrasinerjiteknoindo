$(document).ready(function () {
    $('#tblbarang').DataTable();

    var total = '';
    var html = '';

    // 'http://localhost/tes-mst/transaksi/fetch_transaksi'

    $('#pilihkode').click(function () {
        var kodecustomer = $('#kodecustomer').val();
        $('#inputKode').val(kodecustomer);
        $('#inputKode').focus();
    });

    $('#inputKode').on('focus', function(){
        var kode = $(this).val();
        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/fetch_data_customer',
            method: 'POST',
            data: {'kode': kode},
            success: function(response){
                var dataJson = JSON.parse(response);
                
                $('#inputIdCust').val(dataJson[0].id);
                $('#inputNama').val(dataJson[0].name);
                $('#inputTelp').val(dataJson[0].telp);
            }
        });
    });

    $('#namabarang').on('change',function(){
        var id = $(this).val();

        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/get_hrg_barang',
            method: 'POST',
            data: {'idbarang': id},
            success: function(response){
                var datajson = JSON.parse(response);
                console.log(datajson);
                $('#kodebarang').val(datajson[0].kode);
                $('#hidenamabarang').val(datajson[0].nama);
                $('#hrgbarang').val(datajson[0].harga);
            }
        });
    });

    $('#qtybarang').on('keyup',function(){
        var qtybarang = $(this).val();
        var hrgbarang = $('#hrgbarang').val();
        total = qtybarang * hrgbarang

        $('#total').val(total);
    });

    $('#diskonpct').on('keyup',function(){
        var diskonpct = $(this).val();

        var persen = diskonpct / 100 ;
        var diskonpersen = persen * total;

        var totaldiskon = total - diskonpersen;
        $('#hrgdiskon').val(diskonpersen);
        $('#total').val(totaldiskon);
    });

    $('#diskonrp').on('keyup',function(){
        var diskonrp = $(this).val();
        
        var hrgbarang = $('#hrgbarang').val();
        var hargaafterdiskon = hrgbarang - diskonrp;

        $('#total').val(hargaafterdiskon);
    });

    function gettambahbrg(){
        var inputNo = $('#inputNo').val();

        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/get_tambah_barang',
            method: 'POST',
            data: {'notrx': inputNo},
            success: function(data){
                var datajson = JSON.parse(data);
                console.log(datajson);
                
                let no = 1;

                for (let index = 0; index < datajson.length; index++) {
                    html = `
                        <tr>
                            <td>
                                <button class="btn btn-success">Edit</button>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                            <td>`+no+`</td>
                            <td>`+datajson[index].kode+`</td>
                            <td>`+datajson[index].nama+`</td>
                            <td>`+datajson[index].qty+`</td>
                            <td>`+datajson[index].harga+`</td>
                            <td>`+datajson[index].diskon_pct+`</td>
                            <td>`+datajson[index].diskon_nilai+`</td>
                            <td>`+datajson[index].harga_diskon+`</td>
                            <td>`+datajson[index].total+`</td>
                        </tr>
                    `;

                    no++;
                }

                $('#listtambahbarang').append(html);
                subtotaltambahbrg();
            }
        });
    }

    function subtotaltambahbrg(){
        var inputNo = $('#inputNo').val();

        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/total_tambah_barang',
            method: 'POST',
            data: {'notrx': inputNo},
            success: function(data){
                var datajson = JSON.parse(data);
                console.log(datajson);
                $('#textsubtotal').text(datajson[0].subtotal);
                $('#texttotalbayar').text(datajson[0].subtotal);
            }
        });
    }

    $('#tambahbarang').on('click', function(){
        var inputNo = $('#inputNo').val();
        var namabarang = $('#namabarang').val();
        var hrgbarang = $('#hrgbarang').val();
        var qtybarang = $('#qtybarang').val();
        var diskonpct = $('#diskonpct').val();
        var diskonrp = $('#diskonrp').val();
        var hrgdiskon = $('#hrgdiskon').val();
        var total = $('#total').val();

        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/prosestambahtrx',
            method: 'POST',
            data: {
                'inputNo': inputNo,
                'namabarang': namabarang,
                'hrgbarang': hrgbarang,
                'qtybarang': qtybarang,
                'diskonpct': diskonpct,
                'diskonrp': diskonrp,
                'hrgdiskon': hrgdiskon,
                'total': total
            },
            success: function(){
                gettambahbrg();
            }
        });
    });

    $('#diskonafter').on('keyup', function(){
        var diskonafter = $(this).val();
        var textsubtotal = $('#textsubtotal').text();    
        var hasildiskon = textsubtotal - diskonafter;
        $('#texttotalbayar').text(hasildiskon);
    });

    $('#ongkir').on('keyup', function(){
        var ongkir = $(this).val();
        var textsubtotal = $('#textsubtotal').text();    
        var hasilongkir = parseInt(textsubtotal) + parseInt(ongkir); 
        $('#texttotalbayar').text(hasilongkir);
    });

    $('#simpancusttrx').on('click', function(){
        console.log('tes');
        var inputNo = $('#inputNo').val();
        var inputTgl = $('#inputTgl').val();
        var idcust = $('#inputIdCust').val();
        var textsubtotal = $('#textsubtotal').text(); 
        var diskonafter = $('#diskonafter').val();
        var ongkir = $('#ongkir').val();
        var texttotalbayar = $('#texttotalbayar').text();


        $.ajax({
            url: 'http://localhost/tes-mst/transaksi/tambah_trx_customer',
            method: 'POST',
            data: {
                'kode': inputNo,
                'tgl': inputTgl,
                'cust_id': idcust,
                'subtotal': textsubtotal,
                'diskon': diskonafter,
                'ongkir': ongkir,
                'total_bayar': texttotalbayar
            },
            success: function(){
                alert('Transaksi baru disimpan!');
            }
        });
    });

});

var td = document.getElementById('body-trx').getElementsByTagName('td');
console.log(td);

