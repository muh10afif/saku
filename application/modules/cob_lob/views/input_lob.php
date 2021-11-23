<style>
     .btn-toggle {
        margin: 0 4rem;
        padding: 0;
        position: relative;
        border: none;
        height: 1.5rem;
        width: 3rem;
        border-radius: 1.5rem;
        color: #354558;
        background: #006c45;
    }
    .btn-toggle:focus, .btn-toggle:focus.active, .btn-toggle.focus, .btn-toggle.focus.active {
        outline: none;
        
    }
    .btn-toggle:before, .btn-toggle:after {
        line-height: 1.5rem;
        width: 5rem;
        text-align: center;
        font-weight: 600;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: absolute;
        bottom: 0;
        transition: opacity .25s;
    }
    .btn-toggle:before {
        content: 'Iya';
        left: -5rem;
    }
    .btn-toggle:after {
        content: 'Tidak';
        right: -5rem;
        opacity: .5;
    }
    .btn-toggle > .handle {
        position: absolute;
        top: 0.1875rem;
        left: 0.1875rem;
        width: 1.125rem;
        height: 1.125rem;
        border-radius: 1.125rem;
        background: #fff;
        transition: left .25s;
    }
    .btn-toggle.active {
        transition: background-color .25s;
    }
    .btn-toggle.active {
        background-color: #fc5454;
    }
    .btn-toggle.active > .handle {
        left: 1.6875rem;
        transition: left .25s;
    }
    .btn-toggle.active:before {
        opacity: .5;
    }
    .btn-toggle.active:after {
        opacity: 1;
    }
</style>

<div class="card-body">
  <div class="row">
    <div class="col-md-8">
      <table id="datatable2" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light text-center">
          <tr>
            <th>No</th>
            <th>Nama LOB</th>
            <th>Tipe Diskon</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Nama LOB<b style="color:red;">*</b></label>
        <input type="hidden" name="idlob" id="idlob" name="" value="">
        <input type="text" name="lobnme" id="lobnme" class="form-control" required placeholder="LOB"/>
      </div>
      <div class="form-group">
        <label>Tipe Diskon<b style="color:red;">*</b></label>
        <select class="form-control" name="tdisk" id="tdisk" required>
          <option value="">-- Pilih --</option>
          <option value="premi standar">Premi Standar</option>
          <option value="total premi">Total Premi</option>
        </select>
      </div>
      <div class="form-group mt-2">
            <!-- <div class="custom-control custom-switch">
                <input type="checkbox" name="aktif" class="custom-control-input" id="aktif" checked> 
                <label class="custom-control-label" for="aktif">Aktif</label>
            </div> -->
            <label>Mempunyai Ahli Waris<b style="color:red;">*</b></label> <br>
            <button type="button" class="btn btn-toggle st_ahli_waris" data-toggle="button" aria-pressed="true" autocomplete="off" value="f">
                
            <div class="handle"></div>
            </button>
        </div>

        <input type="hidden" id="val_ahli_waris" name="status" value="f">

      <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i>
      <div class="form-group text-right mt-3">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendlob">Submit</button>
        <?php endif; ?>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearlob">Cancel</button>
      </div>
    </div>
  </div>
</div>
