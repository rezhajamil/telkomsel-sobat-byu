@extends('layouts.app')
@section('body')
    @include('components.navbar')
    <div class="w-full px-4 my-6 h-fit md:px-32">
        <div class="w-full overflow-hidden rounded-md h-fit">
            <img src="{{ asset('images/backdrop.png') }}" alt="Backdrop Sobat byU">
        </div>
    </div>

    <div class="w-full py-4 mt-6 bg-bottom bg-no-repeat bg-cover" x-data="{ banner: false, search: false }"
        style="background-image: url('{{ asset('images/wave-blue.svg') }}')">
        <span
            class="inline-block w-full my-2 text-2xl text-center sm:text-4xl text-sekunder font-batik selection:bg-white selection:text-premier">DAFTAR
            SEKARANG</span>
        <div class="w-10/12 p-4 mx-auto">
            <form action="{{ route('home.store') }}" method="post" x-data="{ modal: false }">
                @csrf
                <div class="grid grid-cols-3 gap-6 mt-4 md:grid-cols-4">
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            id="npsn" placeholder="NPSN Kampus" type="number" name="npsn"
                            value="{{ old('npsn') }}">
                        <span
                            class="inline-block mt-1 text-sm underline transition-all cursor-pointer text-sekunder hover:text-black"
                            id="find-school"><i class="mr-1 text-sm fa-solid fa-magnifying-glass text-sekunder"></i>Cari
                            Sekolah</span>
                        @error('npsn')
                            <span class="inline-block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            placeholder="Nama Lengkap" type="text" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <span class="block mt-1 text-sm italic text-premier">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            id="semester" placeholder="Semester" type="number" name="semester"
                            value="{{ old('semester') }}">
                        @error('semester')
                            <span class="inline-block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            id="email" placeholder="Email" type="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="inline-block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            id="telp" placeholder="Nomor Telepon byU (08512345xxxx)" type="number" name="telp"
                            value="{{ old('telp') }}">
                        @error('telp')
                            <span class="inline-block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <input
                            class="w-full border-2 rounded outline-2 placeholder:text-xs sm:placeholder:text-sm outline-sekunder ring-sekunder border-sekunder"
                            id="wa" placeholder="Nomor Whatsapp (081234567890)" type="number" name="wa"
                            value="{{ old('wa') }}">
                        @error('wa')
                            <span class="inline-block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full col-span-full md:col-span-1">
                        <select name="hobi" id="hobi"
                            class="w-full text-xs border-2 rounded sm:text-sm outline-2 outline-sekunder ring-sekunder border-sekunder sm:">
                            <option value="" selected disabled>Pilih Hobi</option>
                            <option value="Musik" {{ old('hobi') == 'Musik' ? 'selected' : '' }}>Musik</option>
                            <option value="Games" {{ old('hobi') == 'Games' ? 'selected' : '' }}>Games</option>
                            <option value="Video" {{ old('hobi') == 'Video' ? 'selected' : '' }}>Video</option>
                            <option value="Bisnis" {{ old('hobi') == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                        </select>
                        @error('hobi')
                            <span class="block mt-1 text-sm italic text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <button type="submit" class="col-span-3 px-4 py-2 font-bold text-white uppercase transition-all border-2 rounded bg-sekunder hover:text-sekunder border-sekunder hover:bg-white ">Daftar</button> --}}
                    <button
                        class="px-4 py-2 font-bold text-center text-white uppercase transition-all border-2 rounded cursor-pointer col-span-full bg-sekunder hover:text-sekunder border-sekunder hover:bg-white"
                        x-on:click="modal=!modal">Daftar</sp>
                </div>

            </form>
            <div class="fixed inset-0 z-20 flex items-center justify-center w-full h-full overflow-auto bg-black/80"
                style="display:none;" id="search" x-show="search" x-transition>
                <i class="absolute z-10 text-3xl text-white transition cursor-pointer fa-solid fa-xmark top-5 right-10 hover:text-premier"
                    x-on:click="search=false" id="close-search"></i>
                <div class="flex flex-col w-full mx-4 overflow-hidden bg-white rounded-lg sm:w-1/2">
                    <span class="inline-block w-full p-4 mb-4 text-lg font-bold text-center text-white bg-premier">Cari
                        Sekolah</span>
                    <input type="text" class="mx-4 rounded" name="sekolah" id="sekolah"
                        placeholder="Ketik Nama Sekolah" class="mb-4" autofocus>
                    <img src="{{ asset('images/loading.svg') }}" alt="Loading" id="loading"
                        class="w-24 h-24 mx-auto mt-6">
                    <div class="flex flex-col w-full h-64 py-2 mt-2 overflow-auto" id="school-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!session('close_popup'))
        <div class="fixed inset-0 z-20 flex items-center justify-center w-full h-full px-8 py-10 overflow-auto bg-black/80"
            id="popup" x-transition>
            <i class="absolute z-10 text-3xl text-white transition cursor-pointer fa-solid fa-xmark top-5 right-10 hover:text-premier"
                id="close-popup"></i>
            <div class="relative mx-auto rounded w-fit">
                <img src="{{ asset('images/Sobat byU_A4.jpg') }}" alt="Sobat byU" class="max-h-screen my-6">
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="flash-data d-none" data-flashdata="{{ session('success') }}"></div>
        <script>
            var data = document.querySelector(".flash-data").getAttribute("data-flashdata");
            Swal.fire({
                title: 'Pendaftaran Berhasil',
                text: data,
                icon: 'success',
                showCancelButton: false,
            })
        </script>
    @endif
    @if (session('error'))
        <div class="flash-data d-none" data-flashdata="{{ session('error') }}"></div>
        <script>
            var data = document.querySelector(".flash-data").getAttribute("data-flashdata");
            Swal.fire({
                title: 'Pendaftaran Gagal',
                text: data,
                icon: 'error',
                showCancelButton: false,
            })
        </script>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#loading').hide();

            $('#sekolah').on('keypress', function() {
                if (event.which === 13) { // Check if Enter key (key code 13) is pressed
                    $('#loading').show();
                    findSchool();
                }
            })

            $("#find-school").click(function() {
                $("#search").show()
            })

            $("#close-search").click(function() {
                $("#search").hide()
            })

            $("#close-popup").click(function() {
                $("#popup").hide()

                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/update_session') }}", // Define a route for updating the session
                    data: {
                        close_popup: true
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            })

            const findSchool = () => {
                let _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ URL::to('/find_school') }}",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        name: $('#sekolah').val(),
                        _token: _token
                    },
                    success: (data) => {
                        $('#school-list').html(
                            data.map((data) => {
                                return `
                                <div class="flex flex-col p-4 transition border-b-2 cursor-pointer school-item hover:bg-gray-500/50" npsn="${data.NPSN}" x-on:click="search=false">

                                    <span class="font-bold text-sekunder">${data.NAMA_SEKOLAH}</span>
                                    <span class="font-semibold text-tersier">${data.NPSN}</span>
                                </div>
                            `
                            })
                        )
                        $('#loading').hide();

                        $('.school-item').click(function() {
                            let npsn = $(this).attr('npsn');
                            $('#search').hide();
                            $('#npsn').val(npsn);
                        })

                    },
                    error: (e) => {
                        console.log('error', e);
                    }
                })
            }
        })
    </script>
@endsection
