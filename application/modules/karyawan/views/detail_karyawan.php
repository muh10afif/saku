<div class="row p-3">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Kode Karyawan</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['kode_karyawan'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_mop" class="col-md-4 col-form-label text-left">NIK</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['nik'] ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="nm_mop" class="col-md-4 col-form-label text-left">Nama Lengkap</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['nama_karyawan'] ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Email</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['email'] ?></span>
            </div>
        </div>
        
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">No. Telepon</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['telp'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Bagian</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['bagian'] ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left">Jabatan</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['jabatan'] ?></span>
            </div>
        </div>  
    </div>
</div>
<hr>
<div class="row p-3">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Negara</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['negara'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Kota</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['kota'] ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left">Desa</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['desa'] ?></span>
            </div>
        </div>  
          
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Provinsi</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['provinsi'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Kecamatan</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['kecamatan'] ?></span>
            </div>
        </div>  
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left">Alamat</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $karyawan['alamat_karyawan'] ?></span>
            </div>
        </div>  
          
    </div>

</div>