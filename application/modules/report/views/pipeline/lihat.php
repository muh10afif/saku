<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
        <div class="col-sm-6">
        <?php echo bredcumx(); ?>
        </div>
    </div>
</div>

    
<div class="row">
    <div class="col-md-12 f_ubah" style="display: none;">
    <?php $this->load->view('ajk/polis/edit'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_detail" style="display: none;">
    <?php $this->load->view('ajk/polis/detail'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow f_tutup">
            <div class="card-header">
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                    
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Range Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start_date" id="start_date"placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                    
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Tampilkan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 shadow f_tutup">
        <div class="card-header">
                <button type="button" class="btn btn-primary mr-2 text-white right"><a target="_blank" class="text-white" href="<?php echo base_url(); ?>report/pipeline/pipelineexcel">EXPORT EXCEL</a></button>
                <button type="button" class="btn btn-primary mr-2 text-white right"><a target="_blank" class="text-white" href="<?php echo base_url(); ?>report/pipeline/cetak_pdf">EXPORT PDF</a></button>
                
                <!-- <a href="'.base_url().'ajk/polis/cetak_sertifikat/'.$key['id_polis'].'" target="_blank">EXPORT PDF</a></button> -->
                
        </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap tab" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light text-center">
                    <tr>
                        <th rowspan="2">No</th> 
                        <th colspan="2">Periode</th> 
                        <th rowspan="2">Name Of Insured</th> 
                        <th colspan="7">Share And Amount Brokerage</th> 
                        <th rowspan="2">LOB</th> 
                        <th rowspan="2">Insurance</th>
                        <th rowspan="2">Remaks</th>
                        <th rowspan="2">Total Premium</th> 
                        <th rowspan="2">Curent Status</th>
                        <th rowspan="2">Total Brokage</th> 
                        <th rowspan="2">Status Premi</th> 
                        <th rowspan="2">Acount Hendler</th> 
                    </tr>
                    <tr>
                        <!-- Periode -->
                        <th>Form</th>
                        <th>TO</th> 
                        <!-- Share And Amount Brokerage -->
                        <th>Name SOB</th>
                        <th>Discoun (%)</th> 
                        <th>Amount</th> 
                        <th>SOB Share (%)</th> 
                        <th>Amount</th> 
                        <th>OUR Share (%)</th> 
                        <th>Amount</th> 
                    </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/cr-1.3.2/fh-3.1.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script>
    var tabel_pipeline = '';
	$(document).ready(function () {
	
        var act = "<?=$role['update'].'_'.$role['delete']?>";
        tabel_pipeline = $('#datatable').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>report/pipeline/ajaxdatapipeline/"+act,
                "type" : "POST",
                "data" : function(data){
                    data.start_date = $('#start_date').val();
                    data.end_date = $('#end_date').val();
            }
            },
            "columnDefs" : [{
                "targets" : [0,18],
                "orderable" : true
            },{
                'targets' : [0],
                'className' : 'text-center',
            }],
            "scrollX" : true
        });

    })

    
    $('#btn-filter').click(function(){ //button filter event click
            tabel_pipeline.ajax.reload();  //just reload table
    });

    $('#btn-reset').click(function(){ //button reset event click
            $('#form-filter')[0].reset();
            tabel_pipeline.ajax.reload();  //just reload table
    });
</script>