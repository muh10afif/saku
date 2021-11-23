<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -24px;
        position: relative;
        z-index: 2;
    }
</style>
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-7">
      <div class="card shadow">
        <div class="card-body">
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-light text-center">
              <tr>
                <th>No</th>
                <th>Level User</th>
                <th>Otorisasi</th>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">

          <!--LEVEL USER -->
          <div class="form-group">
            <label>Level User<b style="color:red;">*</b></label>
            <?php foreach ($level_user as $key => $value): ?>
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="customCheck<?php echo $value->id_level_user; ?>" value="<?php echo $value->level_user; ?>" data-idleveluser="<?php echo $value->id_level_user; ?>" name="pilihn">
                <label class="custom-control-label" for="customCheck<?php echo $value->id_level_user; ?>"><?php echo $value->level_user; ?></label>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- JENIS DATA CLIENT -->
          <div class="form-group" id="tertanggungdata" style="display: none;">
            <label>Pilih Jenis data Client<b style="color:red;">*</b></label>
            <select class="form-control select2" name="jdclient" id="jdclient" onchange="setupclient(this)">
              <option value="">Pilih</option>
              <?php foreach ($cdb as $s): ?>
                <option value="<?= $s['id_sob'] ?>"><?= $s['sob'] ?></option>
              <?php endforeach; ?>
              <!-- <option value="3">Agent</option>
              <option value="5">Business Partner</option>
              <option value="4">Direct</option>
              <option value="1">Insurer</option>
              <option value="2">Insured</option>
              <option value="6">Loss Adjuster</option> -->
            </select>
          </div>

          <!-- PILIH CDB -->
          <!-- <input type="hidden" id="isi_flag_table">
          <input type="hidden" id="isi_id_pengguna_tertanggung">
          <input type="hidden" id="isi_id_insured">
          <div class="form-group pil_cdb" style="display: none;">
            <label>Pilih CDB<b style="color:red;">*</b></label>
            <select name="pil_cdb" id="pil_cdb" class="form-control select2">
              <option value="">Pilih</option>
              <?php foreach ($cdb as $s): ?>
                <option value="<?= $s['id_sob'] ?>"><?= $s['sob'] ?></option>
              <?php endforeach; ?> -->
              <!-- <option value="3">Agent</option>
              <option value="5">Business Partner</option>
              <option value="4">Direct</option>
              <option value="1">Insurer</option>
              <option value="2">Insured</option>
              <option value="6">Loss Adjuster</option> -->
            <!-- </select>
          </div> -->

          <!-- <div class="form-group pil_tertanggung" style="display: none;">
            <label id="t_cdb">Pilih CDB Tertanggung<b style="color:red;">*</b></label>
            <select name="pil_tertanggung" id="pil_tertanggung" class="form-control select2">
              <option value="">Pilih</option>
            </select>
          </div> -->

          <!-- PILIH PENGGUNA -->
          <div class="form-group" id="sikaryawan">
            <label>Pilih Pengguna<b style="color:red;">*</b></label>
            <select name="pilkarya" id="pilkarya" class="form-control select2" disabled>
              <option value="">Pilih</option>
            </select>
          </div>

          <!-- PILIH INDUK KUMPULAN -->
          <!-- <div class="form-group sel2" style="display: none;">
            <label>Pilih Induk Kumpulan<b style="color:red;">*</b></label>
            <select name="pil_induk_kumpulan" id="pil_induk_kumpulan" class="form-control select2" required data-parsley-required-message="Jenis Client Induk Kumpulan Harus Terisi.">
            <option value="">Pilih</option>
            </select>
          </div> -->

          <div id="form_induk_kumpulan" style="display: none;">

            <div class="form-group sel2">
                <label>Pilih Jenis Client Tertanggung<b style="color:red;">*</b></label>
                <select class="form-control select2" name="jenis_client_ttg" id="jenis_client_ttg" onchange="setupclient_ttg(this.value)" required data-parsley-required-message="Jenis Client Tertanggung Harus Terisi.">
                    <!-- <option value="">Pilih</option>
                    <option value="3">Agent</option>
                    <option value="5">Business Partner</option>
                    <option value="4">Direct</option>
                    <option value="1">Insurer</option>
                    <option value="2">Insured</option>
                    <option value="6">Loss Adjuster</option> -->
                    <?= $option_cdb_ttg ?>
                </select>
            </div>
            <div class="form-group sel2">
                <label>Pilih Tertanggung<b style="color:red;">*</b></label>
                <select name="pil_tertanggung" id="pil_tertanggung" class="form-control select2" onchange="setupclient_jenis_client_ik($('#jenis_client_ttg').val(), this.value)" required data-parsley-required-message="Tertanggung Harus Terisi.">
                <option value="">Pilih</option>
                </select>
            </div>
            <div class="form-group sel2">
                <label>Pilih Jenis Client Induk Kumpulan<b style="color:red;">*</b></label>
                <select class="form-control select2" name="jenis_client_ik" id="jenis_client_ik" onchange="setupclient_ik($('#jenis_client_ttg').val(), $('#pil_tertanggung').val(), this.value)" required data-parsley-required-message="Jenis Induk Kumpulan Harus Terisi.">
                    <option value="">Pilih</option>
                    <!-- <option value="3">Agent</option>
                    <option value="5">Business Partner</option>
                    <option value="4">Direct</option>
                    <option value="1">Insurer</option>
                    <option value="2">Insured</option>
                    <option value="6">Loss Adjuster</option> -->
                </select>
            </div>
            <div class="form-group sel2">
                <label>Pilih Induk Kumpulan<b style="color:red;">*</b></label>
                <select name="pil_induk_kumpulan" id="pil_induk_kumpulan" class="form-control select2" required data-parsley-required-message="Jenis Client Induk Kumpulan Harus Terisi.">
                <option value="">Pilih</option>
                </select>
            </div>

            <input type="hidden" id="ft_tertanggung_edit">
            <input type="hidden" id="tertanggung_edit">
            <input type="hidden" id="ft_induk_kumpulan_edit">
            <input type="hidden" id="induk_kumpulan_edit">

            <input type="hidden" name="id_induk_kumpulan" id="id_induk_kumpulan">

          </div>

          <!-- PENGGUNA TERTANGGUNG -->
          <div class="form-group sel2 f_pgn_tertanggung" style="display: none;">
            <label>Pilih Pengguna Tertanggung<b style="color:red;">*</b></label>
            <input type="hidden" id="pil_pgn_tertanggung_edit">
            <select name="pil_pgn_tertanggung" id="pil_pgn_tertanggung" class="form-control select2" required data-parsley-required-message="Pengguna Tertanggung Harus Terisi.">
            <option value="">Pilih</option>
            </select>
          </div>
          
          <!-- LEVEL OTORISASI -->
          <div class="form-group" id="otorisa">
            <label>Level otorisasi<b style="color:red;">*</b></label>
            <select class="form-control select2" id="lvloto" name="lvloto" required disabled>
              <option value="">Pilih</option>
              <?php foreach ($level_otorisasi as $key => $value): ?>
                <option value="<?php echo $value->id_level_otorisasi ?>"><?php echo $value->level_otorisasi ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- USERNAME & PASSWORD -->
          <div class="form-group">
            <label>Username<b style="color:red;">*</b></label>
            <input type="text" name="usname" id="usname" class="form-control" required placeholder="Username"/>
            <input type="hidden" name="idusr" id="idusr" value="">
          </div>

          <div class="form-group">
            <label>Password<b style="color:red;">*</b></label>
            <input type="password" name="password" id="password" class="form-control" required placeholder="Password"/>
            <i toggle="#password" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
          </div>

          <div class="form-group">
            <label>Confirm Password<b style="color:red;">*</b></label>
            <input type="password" name="con_pass" id="con_pass" class="form-control" required placeholder="Confirm Password"/>
            <i toggle="#con_pass" class="fa fa-smile-beam fa-lg field-icon toggle-password-con"></i>
          </div>

          <i style="color:red;">('*') Menandakan Form Harus di Isi</i><hr>

          <!-- SUBMIT -->
          <div class="form-group text-center">
            <?php if ($role['create'] == true || $role == null): ?>
              <button class="btn btn-primary waves-effect waves-light mr-2" id="senddata">Submit</button>
            <?php endif; ?>
            <button class="btn btn-secondary waves-effect" id="clearall">Cancel</button>
          </div>

        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<input type="hidden" id="id_lvl_oto">

<?php $this->load->view('logicjs'); ?>