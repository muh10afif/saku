<ul class="nav nav-tabs mb-5">
  <li class="nav-item">
    <a class="btn btn-primary nav-link active" data-toggle="tab" href="#neraca">NERACA</a>
  </li>
  <li class="nav-item">
    <a class="btn btn-primary nav-link ml-4" data-toggle="tab" href="#labarugi">LABA RUGI</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active container-fluid" id="neraca">
    <div class="row mb-4">
      <div class="col-md-6 col-lg-6">
      <h5>AKTIVA</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary" >
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_al">
          </tbody>
          <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p  id="total_al"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>
      </div>
       <div class="col-md-6 col-lg-6">
       <h5>HUTANG</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary">
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_ph">
           
          </tbody>
           <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p id="total_ph"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-6 col-lg-6">
       </div>
      <div class="col-md-6 col-lg-6">
       <h5>MODAL</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary">
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_pm">
          </tbody>
           <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p id="total_pm"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>
      </div>
       <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body bg-secondary"><h5 id=total_aktiva></h5></div>
        </div>
       </div>
        <div class="col-md-6 col-lg-6">
          <div class="card">
          <div class="card-body bg-secondary"><h5 id=total_hm></h5></div>
        </div>
       </div>
        <div class="col-md-12 col-lg-12">
          <div class="card">
          <div class="card-body bg-secondary"><h5 id="neraca_cek"></h5></div>
        </div>
       </div>
    </div>
  </div>
  <div class="tab-pane container-fluid" id="labarugi"><div class="row mb-4">
      <div class="col-md-6 col-lg-6">
        <h5>PENDAPATAN</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary">
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_pdpt">
          </tbody>
           <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p  id="total_pdpt"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>

           <h5>PENDAPATAN LAIN-LAIN</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary">
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_pdpt_lain">
          </tbody>
           <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p  id="total_pdpt_lain"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>
      </div>
      <div class="col-md-6 col-lg-6">
          <h5>BIAYA</h5>
       <div class="table-responsive">
        <table class="table table-striped">
          <thead class=" bg-secondary">
            <tr>
              <th scope="col">COA</th>
              <th scope="col">DESKRIPSI</th>
              <th scope="col">JUMLAH</th>
            </tr>
          </thead>
          <tbody id="tb_pb">
          </tbody>
           <tfoot class="bg-secondary">
            <tr>
              <th colspan="2" class="text-right">TOTAL(Rp) =</th>
              <th><p  id="total_pb"></p></th>
            </tr>
          </tfoot>
        </table>
       </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body bg-secondary"><h5 id="total_pdpt_all"></h5></div>
        </div>
      </div>
      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body bg-secondary"><h5 id="total_pb_all"></h5></div>
        </div>
      </div>

      <div class="col-md-12 col-lg-12"> <div class="card">
          <div class="card-body bg-secondary"><h5 id="laba_usaha"></h5></div>
        </div></div>

    </div></div>
</div>