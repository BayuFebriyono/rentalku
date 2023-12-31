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
    <h1 class="mb-4">Detail Paket : {{ $paket->paket }}</h1>

    <p class="text-muted">Input Detail Paket</p>
    <form action="/paket/detail" method="POST">
        @csrf
        <input type="hidden" name="paket_id" value="{{ $paket->id }}">
        <div class="row">
            <div class="col-md-6">
                <p class="mt-4 text-muted"><b>Data Detail Paket</b></p>
                <div class="row">
                    <div class="col-md-3">
                        <label for="KategoriId" class="">Kategori Produk</label>
                    </div>
                    <div class="col-md-9">
                        <select name="kategori_id" id="KategoriId" class="form-select" required>
                            <option value="" disabled selected>---Pilih Kategori---</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="MerkId" class="">Merk Produk</label>
                    </div>
                    <div class="col-md-9">
                        <select name="merk_id" id="MerkId" class="form-select" required>
                            <option value="" disabled selected>---Pilih Merk---</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="TipeId" class="">Tipe Produk</label>
                    </div>
                    <div class="col-md-9">
                        <select name="tipe_id" id="TipeId" class="form-select" required>
                            <option value="" disabled selected>---Pilih Merk---</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">Unit</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="unit" id="Unit" placeholder="1" required>
                    </div>
                </div>

            </div>
            <div class="col-md-6 mt-4">
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">Lama Sewa</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="lama_sewa" id="LamaSewa" placeholder="1 (hari)"
                            required>
                        {{-- <p class="text-muted" id="LbTotalSewa">Total Tarif Sewa : </p> --}}
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-3">
                        <label for="" class="">Tarif Sewa</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="tarif_sewa" id="TarifSewa" readonly required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">Total Tarif Sewa</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="total_tarif_sewa" id="LbTotalSewa"
                            placeholder="Rp." required readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">Komisi Kirim</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="komisi_kirim" id="KomisiKirim" readonly required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">X Komisi</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="xKomisi" id="XKomisi" placeholder="1" required>
                        {{-- <p class="text-muted" id="LbTotalKomisi">Total Komisi : </p> --}}
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="" class="">Total Komisi Kirim</label>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="total_komisi_kirim" id="LbTotalKomisi"
                            placeholder="Rp." required readonly>
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </div>
                </div>

            </div>
        </div>
    </form>




    <div style="overflow-x: auto; margin-top: 80px">
        <table class="table table-striped mt-4 display nowrap" id="myTable" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Lama Sewa</th>
                    <th scope="col">Tarif Sewa</th>
                    <th scope="col">Total Tarif Sewa</th>
                    <th scope="col">X Kirim</th>
                    <th scope="col">Total Komisi Kirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_paket as $dt)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $dt->tipe->tipe }}</td>
                        <td>{{ $dt->unit}}</td>
                        <td>{{ $dt->lama_sewa }}</td>
                        <td>{{ $dt->tipe->tarif_sewa }}</td>
                        <td>{{ $dt->total_tarif_sewa }}</td>
                        <td>{{ $dt->x_kirim }}</td>
                        <td>{{ $dt->total_komisi_kirim }}</td>
                        <td>
                            <form action="/paket/detail/{{ $dt->id }}" class="d-inline"
                                id="myForm{{ $loop->iteration }}" method="POST">
                                @csrf
                                @method('DELETE')
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
            $('#myTable').DataTable({
                scrollX: true
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

        $(document).ready(function() {
            $('#KategoriId').change(function() {
                var KategoriId = $(this).val();
                if (KategoriId) {
                    $.ajax({
                        type: "GET",
                        url: "/getMerk?KategoriId=" + KategoriId,
                        dataType: 'JSON',
                        success: function(res) {
                            if (res) {
                                $("#MerkId").empty();
                                $("#TipeId").empty();
                                $("#MerkId").append(
                                    '<option disabled selected>---Pilih Merk---</option>');
                                $("#TipeId").append(
                                    '<option disabled selected>---Pilih Tipe---</option>');
                                $.each(res, function(merk, id) {
                                    $("#MerkId").append('<option value="' + id +
                                        '">' + merk + '</option>');
                                });
                            } else {
                                $("#MerkId").empty();
                                $("#TipeId").empty();
                            }
                        }
                    });
                } else {
                    $("#MerkId").empty();
                    $("#TipeId").empty();
                }
            });

            $('#MerkId').change(function() {
                var MerkId = $(this).val();
                if (MerkId) {
                    $.ajax({
                        type: "GET",
                        url: "/getTipe?merk_id=" + MerkId,
                        dataType: 'JSON',
                        success: function(res) {
                            if (res) {
                                $("#TipeId").empty();
                                $("#TipeId").append(
                                    '<option disabled selected>---Pilih Tipe---</option>');
                                $.each(res, function(tipe, id) {
                                    $("#TipeId").append('<option value="' + id +
                                        '">' + tipe + '</option>');
                                });
                            } else {
                                $("#TipeId").empty();
                            }
                        }
                    });
                } else {
                    $("#TipeId").empty();
                }
            });


            $('#TipeId').change(function() {
                var TipeId = $(this).val();
                if (TipeId) {
                    $.ajax({
                        type: "GET",
                        url: "/tipeDetail?tipe_id=" + TipeId,
                        dataType: 'JSON',
                        success: function(res) {
                            if (res) {
                                $('#Satuan').val(res.satuan);
                                $('#TarifSewa').val(res.tarif_sewa);
                                $('#KomisiKirim').val(res.komisi_kirim);
                            } else {

                            }
                        }
                    });
                } else {

                }
            });

            // Lama sewa Listener
            $('#LamaSewa').change(function() {
                let total = $('#TarifSewa').val() * $('#Unit').val() * $('#LamaSewa').val();
                $('#LbTotalSewa').val(total);
                $('#TotalTarifSewa').val(total);
            });
            // Unit Listener
            $('#Unit').change(function() {
                let total = $('#TarifSewa').val() * $('#Unit').val() * $('#LamaSewa').val();
                $('#LbTotalSewa').val(total);
                $('#TotalTarifSewa').val(total);
            });
            // KomisiKirimListener
            $('#XKomisi').change(function() {
                let total = $('#KomisiKirim').val() * $('#XKomisi').val();
                $('#LbTotalKomisi').val(total);
                $('#TotalKomisiKirim').val(total);
            });

        });
    </script>
@endsection
