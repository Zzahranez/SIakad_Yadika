<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Makanan | Tambah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body>
    <div class="container ">

        <div class="row">
            <div class=" offset-3 col-md-6">
                <div class="card shadow mt-5 p-3 align-items-center">
                    <form action="{{ route('makanan.store') }}" method="POST">
                        @csrf
                        <h2 class=" text-gray-500">Daftar Makanan</h2>
                        <div class="mb-3">
                            <label for="NamaMakanana" class=" form-label">Nama Makanan :</label>
                            <input type="text" class=" form-control" placeholder="Masukan nama makanan"
                                name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="NamaMakanana" class=" form-label">Harga :</label>
                            <input type="text" class=" form-control" placeholder="Masukkan harga makanan" name="harga">
                        </div>
                        <button class=" btn bg-primary text-white" type="submit">Tambah</button>
                    </form>

                    <a class=" mt-3" href="{{ route('makanan.index') }}">Kembali</a>
                </div>

            </div>

        </div>


    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
