@extends('main.main')
@section('head')
    <link href="{{ asset('datatables/DataTables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert/sweetalert.min.css') }}">
@endsection
@section('content')
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif
    <h1 class="mb-1">Detail No Nota : {{ $transaksi->no_nota }}</h1>
    <h3 class="mb-4">Status : <b @class([ 'text-danger' => !$transaksi->status_pengambilan, 'text-success' => $transaksi->status_pengambilan])>{{ $transaksi->status_pengambilan ?? 'Belum Diambil' }}</b></h3>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/pengambilan/tambah-pengambil" method="POST">
                    @csrf
                    <input type="hidden" name="no_nota" id="NoNota" value="{{ $transaksi->no_nota }}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="Karyawan">Karyawan Yang Bertugas</label>
                            </div>
                            <div class="col-md-9">
                                <select name="karyawan_id" id="Karyawan" class="form-select" required>
                                    @foreach ($karyawan as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div style="overflow-x: auto; margin-top: 80px">
        <table class="table table-striped mt-4 display nowrap" id="myTable" style="width: 100%;">
            <thead>
                <tr>

                    <th scope="col">No</th>
                    <th scope="col">Tipe/Jeis Produk</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Tarif Sewa</th>
                    <th scope="col">Lama Sewa</th>
                    <th scope="col">Total Tarif Sewa</th>
                    <th scope="col">Komisi Kirim</th>
                    <th scope="col">X Kirim</th>
                    <th scope="col">Total Komisi Kirim</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_transaksi as $dt)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $dt->tipe->tipe }}</td>
                        <td>{{ $dt->unit_out }}</td>
                        <td>{{ $dt->tipe->satuan }}</td>
                        <td>{{ $dt->tipe->tarif_sewa }}</td>
                        <td>{{ $dt->lama_sewa }}</td>
                        <td>{{ $dt->tarif_sewa }}</td>
                        <td>{{ $dt->tipe->komisi_kirim }}</td>
                        <td>{{ $dt->x_komisi }}</td>
                        <td>{{ $dt->komisi_kirim }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <div class="row mt-4">
        <div class="d-flex justify-content-start">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Petugas
            </button>
            <form action="/pengambilan/ambil/{{ $transaksi->id }}" class="me-3" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning" id="update-selected">Ambil</button>
            </form>
            <a href="/nota/ambil/{{ $transaksi->id }}" class="btn btn-success me-3">Cetak Nota Ambil</a>
            <a href="/nota/pelunasan/{{$transaksi->id}}" class="btn btn-success me-3">Cetak Nota Lunas</a>
            <a href="/nota/komisi-ambil/{{$transaksi->id}}" class="btn btn-success">Cetak Nota Komisi</a>
        </div>
    </div>

    {{-- Table List Pengirim --}}
    <p class="text-muted mt-2">Daftar Petugas Pengambilan</p>
    <div style="overflow-x: auto;">
        <table class="table table-striped mt-4 display nowrap" id="myTable2" style="width: 100%;">
            <thead>
                <tr>

                    <th scope="col">No</th>
                    <th scope="col">Karyawan Yang Bertugas</th>
                    <th scope="col">Aksi</th>
                    {{-- <th>Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($pengambilan as $p)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $p->karyawan->nama }}</th>
                        <td>
                            <form action="/pengambilan/hapus-pegambil/{{ $p->id }}" class="d-inline"
                                id="myForm{{ $loop->iteration }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="no_nota" value="{{ $transaksi->no_nota }}">
                                <button type="button" class="btn btn-danger"
                                    onclick="deleteData('myForm{{ $loop->iteration }}')"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
@section('bottom')
    <script src="{{ asset('datatables/jQuery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('datatables/DataTables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#myTable').DataTable({
                scrollX: true,
            });

            var dataTable2 = $('#myTable2').DataTable({
                scrollX: true,
            });
        });
    </script>

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $("#exampleModal").modal('show');
            });
        </script>
    @endif

    <script>
        function deleteData(formid) {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById(formid);
                    form.submit();
                }
            })
        }
    </script>

    <script>
        function formatToRupiah(angka) {
            // Format angka ke mata uang Rupiah (IDR)
            return angka.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            });
        }

        function siapKirim(id) {
            $(document).ready(function() {
                $("#exampleModal").modal('show');
                $('#DetailId').val(id);

            });
        }
    </script>
@endsection
