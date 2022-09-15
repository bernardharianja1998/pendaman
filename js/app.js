setInterval(() => {
    var a = new Date();
    var minutes = a.getMinutes() < 10 ? '0' : '';
    var seconds = a.getSeconds() < 10 ? '0' : '';
    var time = a.getHours() + ':' + minutes + a.getMinutes() + ':' + seconds + a.getSeconds(); // Print time
    $('#time').html("-" + " " + time);
}, 1000);

$(document).ready(function () {
    // console.log("ready!");
    $('#displayResult').focus();
    // $('.inputCode').hide();
    // $('.detailPx').hide();
})

function inputNumber(val) {
    // alert(val);
    form.displayResult.value = form.displayResult.value + val;
}

function deleteNumber() {
    var strng = $("#displayResult").val();
    // alert(strng);
    $("#displayResult").val(strng.substring(0, strng.length - 1));
}

function insertAntrian(id_pasien, id_poli, id_pendaftaran, loket = "A") { //taruh default value itu selalu di akhir
    // alert(id_pasien, id_poli);
    var msg = 0;

    const postData = {
        loket: loket,
        id_pasien: id_pasien,
        id_poli: id_poli,
        id_pendaftaran: id_pendaftaran
    };

    const url = server + '/proccess/insertAntrian.php';

    // $.post(url, { postData }, (response) => {
    //     // alert(response.code);
    //     msg = response.code;
    // }).fail(function () {
    //     console.log('POST fail)');
    // }).always(function(){ // or add it here if you always wan to execute on completion regardless of fail or success
    //     console.log('input not ok :(');
    // });

    $.ajax({
        'async': false,
        'type': 'POST',
        'global': false,
        'dataType': 'JSON',
        'url': url,
        'data': postData,
        'success': function (data) {
            msg = data.code;
        }
    });

    return msg;
}

function print(kode_booking) {
    const url = server + 'page/receipt.php?kode_booking='+kode_booking;
    // alert(url);
    // window.open(server, '_blank');
    window.location.href = url;
}

function appendTable() {
    var kode_booking = $("#displayResult").val();
    var toast;

    $.ajax({
        type: 'GET',
        cache: false,
        url: server + '/proccess/getDataPx.php',
        dataType: 'JSON',
        data: { kode_booking: kode_booking },
        success: function (data, status, xml) {
            // alert(data.code);

            // do something is successful
            if (data.code == 200) {
                var result = insertAntrian(data.id_pasien, data.id_poli, data.id_pendaftaran);

                if (result == 200) {
                    // alert(result);
                    print(kode_booking);
                }
                else {
                    // alert(result);
                    toast = msg(500,"Oopss, mohon maaf gagal mencetak tiket nomor antrian!");
                }
            }

            $('.inputCode').remove();
            $('.content').empty();
            $('.content').append(data.detail);

            // $('.detailPx').show();
            // alert(data);

            setTimeout(function () {
                window.location.replace(server);
            }, 5000);
        },
        error: function (xml, status, error) {
            // do something if there was an error
        },
        complete: function (xml, status) {
            // do something after success or error no matter what
            // alert("sukses");
        }
    });
}

function msg(code, msg)
{
    var toast;

    if(code == 200)
    {
        toast = toastr["info"](msg, "INFO");
    }
    else 
    {
        toast = toastr["error"](msg, "ERROR");
    }

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    return toast;
}

function proceed() {
    // alert("print!");
    var strng = $("#displayResult").val();
    var toast;

    if (strng.length > 0) 
    {
        if (strng.length != 13) 
        {
            toast = msg(500,"Oopss, mohon maaf kode booking harus berisi 13 karakter!");
        } 
        else 
        {
            appendTable();
        }
    }
    else 
    {
        toast = msg(500,"Oopss, mohon maaf kode booking tidak boleh dikosongi!");
    }
}