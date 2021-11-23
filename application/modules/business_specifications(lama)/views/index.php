<style type="text/css">
  .col-form-label { font-size: 12px; }
  .swal-wide { width:920px !important; }
</style>
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <div class="card shadow">
      <div class="card-header">
        <h6>Class Of Business - Line Of Business</h6>
      </div>
      <div class="card-body">
        <input type="text" id="caricari" onkeyup="findfindfind()" class="form-control" name="cari_global" placeholder="Cari..."><br>
        <select class="form-control select2" name="slcob" id="slcob" onchange="setlisttab(this)" placeholder="-- Pilih COB --">
          <option value="">-- Pilih COB --</option>
          <?php foreach ($data_cob as $key => $value): ?>
            <option value="<?php echo $value->id_cob; ?>"><?php echo $value->cob; ?></option>
          <?php endforeach; ?>
        </select><br>
        <table class="table table-bordered dt-responsive nowrap">
          <tbody id="myTable"></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="card shadow">
      <div class="card-header" style="padding-bottom: 0.40rem;">
        <div class="row">
          <div class="col-md-8">
            <h6>SPPA's Fields Specification - Based on Class Of Business and Line Of Business</h6>
          </div>
          <div class="col-md-4 text-right">
            <button type="submit" class="btn btn-primary waves-effect waves-light" id="gotofieldsppa" style="margin-bottom: 10px;">Create Field SPPA</button>
          </div>
        </div>
      </div>
      <form id="sendbspc" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h6><b>Line Of Business(LOB) : </b><i id="setnmlob"></i></h6>
              <input type="hidden" name="idlob" id="idlob" value="">
            </div>
            <div class="col-md-8 text-right">
              <?php if ($role['create'] == true || $role == null): ?>
                <button type="submit" class="btn btn-primary waves-effect waves-light" id="setosend" style="margin-bottom: 10px;">Save</button>
                &nbsp;
                <button type="button" class="btn btn-warning waves-effect waves-light" id="setpreview" style="margin-bottom: 10px;">
                  <i class="icon-paper-sheet fa-lg"></i> Preview
                </button>
              <?php endif; ?>
            </div>
          </div>
          <table id="sppainput" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th class="text-center" width="150">Field</th>
                <th class="text-center" width="150">Properties</th>
                <th class="text-center" width="100">Action</th>
              </tr>
            </thead>
            <tbody id="listinput">
              <tr>
                <td>
                  <select class="form-control" name="isfild[]" id="isfild" onchange="getvalueopt(this)">
                    <option value="">-- Pilih --</option>
                  </select>
                </td>
                <td class="text-center">
                  <a class="btn btn-secondary waves-effect waves-light" onclick="storedata(0,this)" data-toggle="modal" data-target="#myModal">
                    <i class="icon-pen-pencil-ruler fa-lg"></i> Input Properties
                  </a>
                  <input type="hidden" name="propasset[]" id="propasset" value="">
                </td>
                <td class="text-center">
                  <a style="cursor:pointer" data-placement="top" title="Tambah" class="btn btn-success waves-effect waves-light" onclick="addrow()"><i class="icon-plus"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<?php $this->load->view('modal_view'); ?>

<?php $this->load->view('js_logic'); ?>
