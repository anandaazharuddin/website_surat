@extends('layouts.app')

@section('main')
<div class="container">
    <h2>Buat Surat</h2>
    
    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return submitForm()">
        @csrf

        <!-- Pengirim (Otomatis User yang Login) -->
        <div class="form-group">
            <label>Pengirim</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
            <input type="hidden" name="pengirim" value="{{ Auth::id() }}">
        </div>

        <!-- Penerima -->
        <div class="form-group">
            <label>Penerima</label>
            <select name="kepada" class="form-control" required>
                <option disabled selected>Pilih Penerima</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
     
        <!-- Tembusan -->
        <div class="form-group">
            <label>Tembusan</label>
            <div style="max-height: 200px; overflow-y: auto; border: 1px solid #53e5ff; padding: 10px; border-radius: 5px;">
                @foreach($users as $user)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tembusan[]" value="{{ $user->id }}" id="user{{ $user->id }}">
                        <label class="form-check-label" for="user{{ $user->id }}">
                            {{ $user->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    
        <!-- Pemeriksa -->
        <div class="form-group">
            <label>Pemeriksa</label>
            <select name="pemeriksa" class="form-control" required>
                <option disabled selected>Pilih Pemeriksa</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Perihal -->
        <div class="form-group">
            <label>Perihal</label>
            <input type="text" name="perihal" class="form-control" placeholder="Masukkan Perihal" required>
        </div>

        <!-- Isi Surat-->
        <div class="mb-3">
            <label for="isi_surat" class="form-label">Isi Surat</label>
            <textarea id="isi_surat" name="isi_surat" class="form-control" rows="6" required></textarea>
        </div>


        <!-- File Attachment -->
        <div class="form-group">
            <label>File Attachment (Opsional, PDF/DOC, max 2MB)</label>
            <input type="file" name="file_attachment" class="form-control">
        </div>

        <!-- Tombol Aksi -->
        <button type="submit" name="action" value="kirim" class="btn btn-success">Kirim Surat</button>
        <button type="button" class="btn btn-info" onclick="previewSurat()">Preview</button>
    </form>
</div>

<script>
    function previewSurat() {
        // Mengambil nilai dari form input
        let perihal = document.querySelector("input[name='perihal']").value;
        let isiSurat = document.querySelector("textarea[name='isi_surat']").value;

        // Membuat jendela preview baru
        let previewWindow = window.open("", "_blank", "width=600,height=400");

        // Membuat konten kop surat dan surat
        let kopSurat = `
            <div style="text-align: center; font-family: Times New Roman, sans-serif; margin-bottom: 20px;">
                <h1 style="margin: 0;">Jasa Tirta 1</h1>
                <img src="Public/img/jasatirta1.png" alt="Logo Instansi" style="width: 120px; height: auto; margin-bottom: 10px;">
                <p style="font-size: 14px; margin: 0;">Alamat: 2JM9+J7W, Jl. Surabaya Dalam, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65115 | Kontak: (0341) 551971</p>
                <hr style="border: 1px solid #000; width: 80%; margin: 20px auto;">
            </div>
        `;
        
        // Menambahkan informasi surat
        let suratInfo = `
            <p><strong>Perihal:</strong> ${perihal}</p>
            <p><strong>Tanggal:</strong> ${new Date().toLocaleString()}</p>
            <hr style="border: 1px solid #000; margin: 20px 0;">
        `;

        // Membuat isi surat
        let suratContent = `
            <p>${isiSurat.replace(/\n/g, "<br>")}</p>
        `;

        // Menulis konten ke dalam jendela preview
        previewWindow.document.write("<html><head><title>Preview Surat</title></head><body>");
        previewWindow.document.write(kopSurat);  // Menambahkan kop surat
        previewWindow.document.write(suratInfo); // Menambahkan informasi surat
        previewWindow.document.write(suratContent);  // Menambahkan isi surat
        previewWindow.document.write("</body></html>");
        previewWindow.document.close();
    }
</script>






<script>
    $(document).ready(function () {
        $('#tembusan').select2({
            placeholder: "Pilih Tembusan (Bisa lebih dari satu)",
            allowClear: true
        });
    });
</script>

@endsection
