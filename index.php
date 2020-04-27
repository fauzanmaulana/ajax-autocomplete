<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>autocomplete</title>
</head>
<body>
    
    <div class="container">
        <h2 class="my-4 text-center">Autocomplete Dengan Gambar Dan Ajax</h2>

        <input type="text" id="namasiswa" class="form-control" placeholder="cari siswa..">

        <ul class="list-group" id="resultlist"></ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js"integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>

    <script>
        $(document).ready(() => {
            $.ajaxSetup({chace:false})
            $('#namasiswa').keyup(() => {
                $('#resultlist').html('')
                const namasiswa = $('#namasiswa').val()

                $.ajax({
                    type: 'POST',
                    url: 'get_data.php',
                    data: {nama : namasiswa},
                    success: data => {
                        console.log(data)
                        $.each(JSON.parse(data), (key, val) => {
                            $('#resultlist').append(`
                                <li class="list-group-item link-class">
                                    <img src="assets/${val.avatar}" height="40" width="40" class="img-thumbnail" /> 
                                    <span class="nama">${val.nama}</span>
                                    <span class="text-muted" style="float: right;">${val.alamat}</span>
                                </li>
                            `);
                        })
                    }
                })
                
                $('#resultlist').on('click', 'li', function () {
                    let nama_siswa = $(this).children('.nama').text();
                    $('#namasiswa').val(nama_siswa);
                    $("#resultlist").html('');
                });
            })
        })
    </script>
</body>
</html>