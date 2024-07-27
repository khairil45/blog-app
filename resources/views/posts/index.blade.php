<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Post</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action='' method='post'>
                @csrf

                @if (Route::current()->uri == 'post/{id}')
                    @method('patch')
                @endif

                <div class="mb-3 row">
                    <label for="title" class="col-sm-2 col-form-label">Judul Postingan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ isset($post['title']) ? $post['title'] : '' }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="content" class="col-sm-2 col-form-label">Konten</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='content' id="content"
                            value="{{ isset($post['content']) ? $post['content'] : '' }}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        @if (Route::current()->uri == 'posts')


            <!-- START DATA -->
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-4">Judul</th>
                            <th class="col-md-3">Konten</th>
                            <th class="col-md-2">Tanggal Publikasi</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>{{ $post['content'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($post['created_at'])) }}</td>
                                <td>
                                    <a href="{{ url('post/' . $post['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ url('post/' . $post['id']) }}" method="post"
                                        onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')"
                                        class="d-inline">
                                        @csrf

                                        @method('delete')
                                        <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- AKHIR DATA -->
        @endif
    </main>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
