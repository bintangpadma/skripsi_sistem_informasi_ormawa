<div class="modal" id="checkModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Tambah Divisi</p>
        </div>
        <div class="content-body">
            <form id="buttonCheckPIC" class="form" method="POST" action="{{ route('pic.check') }}">
                @csrf

                <input type="hidden" name="events_id" value="{{ $event->id ?? '' }}">
                <input type="hidden" name="link" id="link">
                <input type="hidden" name="events_id" id="events_id">
                
                <div class="form-input">
                    <label>Nama PIC</label>
                    <input type="text" name="username" class="input" placeholder="Masukkan username PIC">
                </div>

                <div class="form-input">
                    <label>Password</label>
                    <input type="password" name="password" class="input" placeholder="Masukkan password PIC">
                </div>

                <div class="button-group">
                    <button type="submit" class="button-primary">Check Akun PIC</button>
                    <button type="button" onclick="closeModal('checkModal')" class="button-secondary">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-content">
        <div class="content-header">
            <p>Hapus Pic</p>
        </div>
        <div class="content-body">
            <form id="buttonDeletePic" class="form" method="POST">
                @csrf
                @method('DELETE')
                <p>Menghapus data PIC ini dapat mempengaruhi proses lain yang sedang berlangsung. Apakah Anda yakin ingin melanjutkan?</p>
                <div class="button-group">
                    <button type="submit" class="button-primary">Hapus Pic</button>
                    <button type="button" onclick="closeModal('deleteModal')" class="button-secondary">Batal Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
