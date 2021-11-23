<script type="text/javascript">
    
$(document).ready(function() {

    // 10-08-2021
    // menampilkan list jurnal
    var tabel_jurnal = $('#tabel_jurnal').DataTable({
        "processing"        : true,
        "serverSide"        : true,
        "order"             : [],
        "ajax"              : {
            "url"   : "<?= base_url() ?>Jurnal_buku_besar/tampil_data_jurnal",
            "type"  : "POST",
            "data"  : function (data) {
                data.bulan              = $('#fil_jur_bulan').val();
                data.read               = "<?= $role['read'] ?>";
                data.create             = "<?= $role['create'] ?>";
                data.update             = "<?= $role['update'] ?>";
                data.delete             = "<?= $role['delete'] ?>";
                data.id_user            = "<?= $id_user ?>";
                data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
            }
        },
        "columnDefs"        : [{
            "targets"   : [0,7],
            "orderable" : false
        }, {
            'targets'   : [0,6,7],
            'className' : 'text-center',
        }]
    })

    // 13-08-2021
    $('#tabel_jurnal').on('click', '.j_hapus', function () {

        var id_jurnal = $(this).attr('data');

        swal({
            title       : 'Konfirmasi',
            text        : 'Yakin akan hapus data?',
            type        : 'warning',

            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            cancelButtonClass   : "btn btn-danger mr-3",

            showCancelButton    : true,
            confirmButtonText   : 'Ya',
            confirmButtonColor  : '#3085d6',
            cancelButtonColor   : '#d33',
            cancelButtonText    : 'Batal',
            reverseButtons      : true,
            allowOutsideClick   : false
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url     : "<?= base_url() ?>Jurnal_buku_besar/hapus_jurnal",
                    type    : "POST",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            },
                            allowOutsideClick   : false
                        })
                    },
                    data    : {
                        id : id_jurnal
                    },
                    dataType: "JSON",
                    success : function (data) {

                        tabel_jurnal.ajax.reload(null, false);
                        
                        swal({
                            title               : "Berhasil",
                            text                : "Data berhasil dihapus",
                            type                : 'success',
                            showConfirmButton   : false,
                            timer               : 1500,
                            allowOutsideClick   : false
                        });
                        
                    }
                })
        
                return false;

            } else if (result.dismiss === swal.DismissReason.cancel) {

                swal({
                    title               : "Batal",
                    text                : 'Anda membatalkan hapus data',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'error',
                    showConfirmButton   : false,
                    timer               : 1500
                }); 
            }
        })

        return false;
        
    })

    // 13-08-2021
    $('#tabel_jurnal').on('click','.j_info',function() {
        var id_jurnal = $(this).attr('data');

        $.ajax({
                type    : 'POST',
                url     : "<?= base_url('Jurnal_buku_besar/get_info') ?>",
                // async   : false,
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Menampilkan Data',
                        onOpen  : () => {
                            swal.showLoading();
                        },
                        allowOutsideClick   : false
                    })
                },
                data    : {id:id_jurnal},
                dataType : 'JSON',
                success : function(data){
                    swal.close();

                    $('#info').modal('show');
                    $('#info-text').text(data.keterangan);
                }
        })        
    })

    // 13-08-2021
    $('#tabel_jurnal').on('click','.j_edit',function() {
        var id_jurnal = $(this).attr('data');
        
        location.href = "<?= base_url('Jurnal_buku_besar/hal_edit_jurnal/') ?>"+id_jurnal;
    })

    //  var loading = $.loading();

    function startAjax() {
        $.get('http://www.google.com', function () {
        });
    }
    function openLoading() {
        loading.open();
    }

    function closeLoading() {
        loading.close();
    }

    function number_format(x) {
        if (x != null ) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        else
        {
            "";
        }
        
    }

	tampil_jurnal();
	 var tbl_jr = $('#tbl_jurnal').DataTable({
        scrollX:true,
        responsive:true,
     });

	function tampil_jurnal() {
		$.ajax({
                type  : 'ajax',
                url   : 'Jurnal_buku_besar/get_jurnal',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data['data_jurnal'].length; i++){
                        if(data['data_jurnal'][i].status == 1 ){
                            var status = "<span class='badge badge-success'>Terposting</span>";
                            var hide ="hidden";
                            var hides ="hidden";
                        }else if(data['data_jurnal'][i].status == 0){
                            var status = "<span class='badge badge-danger'>Belum Posting</span>";
                            var hide ="hidden";
                            var hides ="";
                        }
                        else if(data['data_jurnal'][i].status == 3){
                            var status = "<span class='badge badge-primary'>Telah Diperbaiki</span>";
                            var hide ="hidden";
                            var hides ="";
                        }
                        // else if(data['userdata'].nama_posisi != "Kepala Departemen Keuangan")
                        else if(data['userdata'] != "Kepala Departemen Keuangan")
                            { var status ="<span class='badge badge-warning'>Butuh Perbaikan</span>";
                        var hide =""
                        var hides ="";
                                }
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td width="150px;">'+data['data_jurnal'][i].kode_transaksi+'</td>'+
                                '<td>'+data['data_jurnal'][i].nama_transaksi+'</td>'+
                                '<td>'+data['data_jurnal'][i].tgl_buat+'</td>'+
                                '<td>'+number_format(data['data_jurnal'][i].total_debit)+'</td>'+
                                '<td>'+number_format(data['data_jurnal'][i].total_kredit)+'</td>'+
                                '<td>'+status+'</td>'+
                                '<td width="200px;" class="text-center">'+
                                '<button  class="btn btn-warning btn-xs j_edit" data="'+data['data_jurnal'][i].id_jurnal+'" '+hide+' data-toggle="tooltip" data-placement="left" title="edit"><i class="fa fa-edit"></i></button>'+' '+
                                '<button  class="btn btn-info btn-xs j_detail" data="'+data['data_jurnal'][i].id_jurnal+'" data-toggle="tooltip" data-placement="left" title="detail"><i class="fa fa-file"></i></button>'+' '+
                                '<button  class="btn btn-danger btn-xs j_hapus" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="hapus"><i class="fa fa-trash"></i></button>'+' '+
                                '<button  class="btn btn-success btn-xs j_info" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="info"><i class="fa fa-info-circle"></i></button>'+' '+
                                // '<button  class="btn btn-primary btn-xs j_set" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+'><i class="fa fa-info-circle"></i></button>'+' '+
                                '</td>'+
                                '</tr>'
                    }
                    $('#show_jurnal').html(html);
                }

            });
	}

     $('#fil_jur_bulan').on('change', function () {

        tabel_jurnal.ajax.reload(null, false);
        // var val_bulan = $(this).val();
        // $('#tbl_jurnal').DataTable().clear().destroy();
        // $.ajax({
        //         type  : 'POST',
        //         url   : 'Jurnal_buku_besar/get_jurnal_fil',
        //         async : false,
        //         dataType : 'json',
        //         data : {val_bulan:val_bulan},
        //         success : function(data){
        //             var html = '';
        //             var i;
        //             for(i=0; i<data['data_jurnal'].length; i++){
        //                 if(data['data_jurnal'][i].status == 1 ){
        //                     var status = "<span class='badge badge-success'>Terposting</span>";
        //                     var hide ="hidden";
        //                     var hides ="hidden";
        //                 }else if(data['data_jurnal'][i].status == 0){
        //                     var status = "<span class='badge badge-danger'>Belum Posting</span>";
        //                     var hide ="hidden";
        //                     var hides ="";
        //                 }
        //                 else if(data['data_jurnal'][i].status == 3){
        //                     var status = "<span class='badge badge-primary'>Telah Diperbaiki</span>";
        //                     var hide ="hidden";
        //                     var hides ="";
        //                 }
        //                 else if(data['userdata'].nama_posisi != "Kepala Departemen Keuangan")
        //                     { var status ="<span class='badge badge-warning'>Butuh Perbaikan</span>";
        //                 var hide =""
        //                 var hides ="";
        //                         }
        //                 html += '<tr>'+
        //                         '<td>'+(i+1)+'</td>'+
        //                         '<td width="150px;">'+data['data_jurnal'][i].kode_transaksi+'</td>'+
        //                         '<td>'+data['data_jurnal'][i].nama_transaksi+'</td>'+
        //                         '<td>'+data['data_jurnal'][i].tgl_buat+'</td>'+
        //                         '<td>'+data['data_jurnal'][i].total_debit+'</td>'+
        //                         '<td>'+data['data_jurnal'][i].total_kredit+'</td>'+
        //                         '<td>'+status+'</td>'+
        //                         '<td width="200px;" class="text-center">'+
        //                         '<button  class="btn btn-warning btn-xs j_edit" data="'+data['data_jurnal'][i].id_jurnal+'" '+hide+' data-toggle="tooltip" data-placement="left" title="edit"><i class="fa fa-edit"></i></button>'+' '+
        //                         '<button  class="btn btn-info btn-xs j_detail" data="'+data['data_jurnal'][i].id_jurnal+'" data-toggle="tooltip" data-placement="left" title="detail"><i class="fa fa-file"></i></button>'+' '+
        //                         '<button  class="btn btn-danger btn-xs j_hapus" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="hapus"><i class="fa fa-trash"></i></button>'+' '+
        //                         '<button  class="btn btn-success btn-xs j_info" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="info"><i class="fa fa-info-circle"></i></button>'+' '+
        //                         // '<button  class="btn btn-primary btn-xs j_set" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+'><i class="fa fa-info-circle"></i></button>'+' '+
        //                         '</td>'+
        //                         '</tr>'
        //             }
        //             $('#show_jurnal').html(html);
        //              var tbl_jr = $('#tbl_jurnal').DataTable({
        //                 scrollX:true,
        //                 responsive:true,
        //              });
        //         }

        //     });

    });

    $('#show_jurnal').on('click','.j_info',function() {
        var id = $(this).attr('data');
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/get_info',
                async : false,
                data : {id:id},
                dataType : 'json',
                success : function(data){
                $('#info').modal('show');
                $('#info-text').text(data.keterangan);

                }
        })        
    })

    $('#show_jurnal').on('click','.j_edit',function() {
        var id = $(this).attr('data');
        $('#b_jurnal').attr('data',id);
        $('#b_jurnal_p').attr('data',id);
        $('#id_jurnal_perbaikan').val(id);
        $('#id_jurnal').val(id);
         $('#id_jurnalk').val(id);
        $('#b_jurnal').hide();
        $('#b_jurnal_p').show();
        $('[href="#form_jurnal"]').tab('show');
        tampil_list_form_jurnal(id);
         $('#tbl_list_form_jurnal').DataTable({
            scrollX:true,
            retrieve: true
         });


    })

    $('#show_jurnal').on('click','.j_hapus',function() {
         var id = $(this).attr('data');
         Swal.fire({
          title: 'Yakin ingin menghapus data ini?',
          text: "data yang sudah dihapus tidak dapat kembali!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'YA!'
        }).then((result) => {
          if (result.value) {
          $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/hapus_jurnal',
                async : false,
                data : {id:id}, 
                dataType : 'json',
                success : function(data){
                tampil_jurnal();
                tampil_buku_besar();
                Swal.fire('Data Berhasil Dihapus!','','success');
                }

            });
           }
        })
    });

     $('#tabel_jurnal').on('click','.j_detail',function() {
        var id_jurnal = $(this).attr('data');

        location.href   = "<?= base_url('jurnal_buku_besar/hal_detail_jurnal/') ?>"+id_jurnal;

        // $.ajax({
        //         type  : 'get',
        //         url   : 'Jurnal_buku_besar/detail_jurnal',
        //         async : false,
        //         data  : {id:id},
        //         dataType : 'json',
        //         success : function(data){

        //             var html = '';
        //             var i;
        //             for(i=0; i<data.length; i++){
        //                 var s = data[i].status;
        //                 var sj = data[i].status_jurnal;
        //                 if (sj == 1) {
        //                 $('#post_jurnal').hide();
        //                 $('#btn_modal_j_err').hide();
        //                  var st = "disabled";
        //                 }
        //                 else {
        //                     $('#post_jurnal').show();
        //                 $('#btn_modal_j_err').show();
        //                 }
        //                 if (s == 1) {
        //                     var status = "checked";
        //                 }
        //                 else{var status=""};

        //                 html += '<tr>'+
        //                         '<td>'+(i+1)+'</td>'+
        //                         '<td class="text-center">'+
        //                         '<div class="form-check">'+
        //                         '<input type="checkbox" class="form-check-input check" '+status+' data="'+data[i].id_detail_jurnal+'" '+st+'>'+
        //                       '</div>'+
        //                         '</td>'+
        //                         '<td>'+data[i].coa+'</td>'+
        //                         '<td>'+data[i].deskripsi_coa+'</td>'+
        //                         '<td>'+data[i].tgl_transaksi+'</td>'+
        //                         '<td>'+number_format(data[i].debit)+'</td>'+
        //                         '<td>'+number_format(data[i].kredit)+'</td>'+
        //                         '</tr>'
        //                         $('#post_jurnal').attr('data',data[i].id_jurnal);
        //                         $('#id_jurnal_err').val(data[i].id_jurnal);
        //                         $('#btn_modal_j_err').attr('data',data[i].id_jurnal);


        //             }
        //             $('#show_detail_jurnal').html(html);
        //             $('#tbl_detail_jurnal').DataTable();
        //             $('[href="#detail_jurnal"]').tab('show');
        //         }

        //     });

     });


     $('#btn_s_jurnal_err').on('click',function(){
         var catatan = $('#catatan').val();
         var id = $('#id_jurnal_err').val();

         $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/s_jurnal_err',
                async : false,
                data  : {id:id,catatan:catatan},
                dataType : 'json',
                success : function(data){
                $('#modal_err_data').modal('hide');
                Swal.fire('Data Berhasil Disimpan!','','success');
                tampil_jurnal();
                $('[href="#home"]').tab('show');
                }
            })

     })



     $('#b_jurnal').on('click',function() {
        var id = $(this).attr('data');
         $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/cek_balance_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                error: function(xmlhttprequest, data, message) {
                if(data === false )  {
                    alert("got timeout");
                } else {
                    alert(textstatus);
                }
                },
                success : function(data){
                    if (data == true) {
                        $('[href="#home"]').tab('show');
                        tampil_jurnal();
                        setTimeout(function(){// wait for 5 secs(2)
                       location.reload(); // then reload the page.(3)
                        }, 50);
                        Swal.fire('Data Berhasil Disimpan!','','success');
                    }
                    else
                    {
                        Swal.fire('Data Tidak Balance!','','warning');
                    }

                }   
            
            });

     })

		 $('#b_jurnalh').on('click',function() {
				var id = $(this).attr('data');
				 $.ajax({
								type  : 'POST',
								url   : 'Jurnal_buku_besar/cek_balance_det',
								async : false,
								data  : {id:id},
								dataType : 'json',
								success : function(data){
										if (data == true) {
												$('[href="#home"]').tab('show');
                                                tampil_jurnal();
                                                setTimeout(function(){// wait for 5 secs(2)
                                               location.reload(); // then reload the page.(3)
                                                }, 50);
												Swal.fire('Data Berhasil Disimpan!','','success');
										}
										else
										{
												Swal.fire('Data Tidak Balance!','','warning');
										}

								}

						});

		 })

     $('#b_jurnal_p').on('click',function() {
        var id = $(this).attr('data');
         $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/cek_balance_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    if (data == true) {
                        u_j_perbaikan(id)
                    }
                    else
                    {
                        Swal.fire('Data Tidak Balance!','','warning');
                    }

                }

            });

     })

     function u_j_perbaikan(id) {
         $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/u_j_perbaikan',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    tampil_jurnal()
                        $('[href="#home"]').tab('show');
                        Swal.fire('Data Berhasil Disimpan!','','success');
                 }

            });
     }

     $("#show_detail_jurnal").on('change','.check',function() {
        if(!this.checked) {
            var id = $(this).attr('data');
             $.ajax({
                    type  : 'POST',
                    url   : 'Jurnal_buku_besar/uc_status_dj',
                    async : false,
                    data : {id:id},
                    dataType : 'json',
                    success : function(data){

                    }
         });
        }
        else{
            var id = $(this).attr('data');
             $.ajax({
                    type  : 'POST',
                    url   : 'Jurnal_buku_besar/c_status_dj',
                    async : false,
                    data : {id:id},
                    dataType : 'json',
                    success : function(data){

                    }
         });
        }
    });

    $('#btn-add-name-tr').on('click',function () {
        var nama_tr = $('#nama_transaksi').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/add_jurnal',
                async : false,
                data : {nama_tr:nama_tr},
                dataType : 'json',
                success : function(data){
               for(i=0; i<data.length; i++){
                var id_jurnal = data[i].id_jurnal;
               }
                tampil_jurnal();
                $('#id_jurnal').val(id_jurnal);
                $('#id_jurnalk').val(id_jurnal);
                $('#add-name-jurnal').modal('hide');
                $('#b_jurnal').attr('data',id_jurnal);
                $('#b_jurnal_p').attr('data',id_jurnal);
                $('#b_jurnal').show();
                $('#b_jurnal_p').hide();
                $('[href="#form_jurnal"]').tab('show');
                tampil_list_form_jurnal(id_jurnal)
                }

            });
    });


    $('#btn-save-jd').on('click',function(){
        var id = $('#id_jurnal').val();
        var group = $('#group').val();
        var des_coa = $('#des_coa').val();
        var tgl_transaksi = $('#tgl_transaksi').val();
        var debit = $('#nominal').val();
        var keterangan = $('#keterangan').val();
        var pelaksana =  $('#pelaksana').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jd',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,debit:debit,keterangan:keterangan,pelaksana:pelaksana,group:group},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 $('#tgl_transaksik').val(tgl_transaksi);
                 $('#keterangank').val(keterangan);
                 $("#pelaksanak").val(pelaksana).trigger('change');
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });

    })
     $('#btn-save-jk').on('click',function(){
        var id = $('#id_jurnalk').val();
        var groupk = $('#groupk').val();
        var des_coa = $('#des_coak').val();
        var tgl_transaksi = $('#tgl_transaksik').val();
        var kredit = $('#nominalk').val();
        var keterangan = $('#keterangank').val();
        var pelaksana =  $('#pelaksanak').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jk',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,kredit:kredit,keterangan:keterangan,pelaksana:pelaksana,groupk:groupk},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });

    })

      function tampil_list_form_jurnal(id) {
        if (id > 0 ) {
            id=id
        }
        else{
         var id= $('#id2').val();
        }
        $.ajax({
                type  : 'get',
                url   : 'Jurnal_buku_besar/get_list_form_jurnal',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+data[i].coa+'</td>'+
                                '<td>'+data[i].deskripsi+'</td>'+
                                '<td>'+data[i].tgl_transaksi+'</td>'+
                                '<td>'+number_format(data[i].debit)+'</td>'+
                                '<td>'+number_format(data[i].kredit)+'</td>'+
                                '<td class="text-center">'+
                                    '<button  class="btn btn-success btn-xs j_edit" data-id="'+data[i].id_jurnal+'" data="'+data[i].id_detail_jurnal+'"><i class="fa fa-edit"></i></button>'+' '+
                                     '<button  class="btn btn-danger btn-xs j_hapus"data-id="'+data[i].id_jurnal+'" data="'+data[i].id_detail_jurnal+'"><i class="fa fa-trash"></i></button>'+' '+
                                '</td>'+
                                '</tr>'
                    }
                    $('#show_list_form_jurnal').html(html);
                    $('#show_list_form_jurnalh').html(html);
                }

            });
    }

    $('#show_list_form_jurnal').on('click','.j_hapus',function() {
        var id = $(this).attr('data');
        var id_jurnal = $(this).data('id');
        Swal.fire({
          title: 'Yakin ingin menghapus data ini?',
          text: "data yang sudah dihapus tidak dapat kembali!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'YA!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/hapus_list_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                // var id_jurnal = $('#id_jurnal_perbaikan').val();
                tampil_list_form_jurnal(id_jurnal);
                $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                    Swal.fire(
              'Berhasil!',
              'Data anda telah dihapus',
              'success'
            )

                }

            });

          }
        })
        });

    $('#show_list_form_jurnalh').on('click','.j_hapus',function() {
        var id = $(this).attr('data');
        var id_jurnal = $(this).data('id');
        Swal.fire({
          title: 'Yakin ingin menghapus data ini?',
          text: "data yang sudah dihapus tidak dapat kembali!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'YA!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/hapus_list_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                // var id_jurnal = $('#id_jurnal_perbaikan').val();
                tampil_list_form_jurnal(id_jurnal);
                $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                    Swal.fire(
              'Berhasil!',
              'Data anda telah dihapus',
              'success'
            )

                }

            });

          }
        })
        });

    $('#show_list_form_jurnal').on('click','.j_edit',function() {
        var id = $(this).attr('data');
        var id_jurnal = $(this).data('id');
        $.ajax({
                type  : 'GET',
                url   : 'Jurnal_buku_besar/edit_list_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    for(i=0; i<data.length; i++){
                        var debit = data[i].debit;
                        if (debit > 0 ) {
                            var nominal = debit;
                             $('#btn-update-jk').hide();
                            $('#btn-update-jd').show();

                        }
                        else{
                            var nominal = data[i].kredit;
                            $('#btn-update-jk').show();
                            $('#btn-update-jd').hide();
                        }
                        $('#id2').val(id);
                        $('#id_jurnal_perbaikan').val(id_jurnal);
                        $('#group2').val(data[i].id_group).trigger('change');
                        $('#head_coa2').val(data[i].no_coa_head).trigger('change');
                        $('#main_coa2').val(data[i].no_coa_main).trigger('change');
                        $('#des_coa2').val(data[i].coa).trigger('change');
                        $("#pelaksana2").val(data[i].pelaksana).trigger('change');
                        $('#nominal2').val(nominal);
                        $('#tgl_transaksi2').val(data[i].tgl_transaksi);
                        $('#keterangan2').val(data[i].keterangan);
                    }

                    $('#edit-list').modal('show');
                }
            })
    })

    $('#show_list_form_jurnalh').on('click','.j_edit',function() {
        var id = $(this).attr('data');
        var id_jurnal = $(this).data('id');
        $.ajax({
                type  : 'GET',
                url   : 'Jurnal_buku_besar/edit_list_det',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    for(i=0; i<data.length; i++){
                        var debit = data[i].debit;
                        if (debit > 0 ) {
                            var nominal = debit;
                             $('#btn-update-jk').hide();
                            $('#btn-update-jd').show();

                        }
                        else{
                            var nominal = data[i].kredit;
                            $('#btn-update-jk').show();
                            $('#btn-update-jd').hide();
                        }
                        $('#id2').val(id);
                        $('#id_jurnal_perbaikan').val(id_jurnal);
                        $('#group2').val(data[i].id_group).trigger('change');
                        $('#head_coa2').val(data[i].no_coa_head).trigger('change');
                        $('#main_coa2').val(data[i].no_coa_main).trigger('change');
                        $('#des_coa2').val(data[i].coa).trigger('change');
                        $("#pelaksana2").val(data[i].pelaksana).trigger('change');
                        $('#nominal2').val(nominal);
                        $('#tgl_transaksi2').val(data[i].tgl_transaksi);
                        $('#keterangan2').val(data[i].keterangan);
                    }

                    $('#edit-list').modal('show');
                }
            })
    })

    $('#btn-update-jd').on('click',function(){
        var id = $('#id2').val();
        var tgl_transaksi = $('#tgl_transaksi2').val();
        var debit = $('#nominal2').val();
        var keterangan = $('#keterangan2').val();
        var pelaksana =  $('#pelaksana2').val();
        var des_coa  = $('#des_coa2').val();
        var group    = $('#group2').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/update_jd',
                async : false,
                data  : {id:id,tgl_transaksi:tgl_transaksi,debit:debit,keterangan:keterangan,pelaksana:pelaksana,des_coa:des_coa,group:group},
                dataType : 'JSON',
                success : function(data){
                $('#edit-list').modal('hide');
                 var id_jurnal = $('#id_jurnal_perbaikan').val();
                 tampil_list_form_jurnal(id_jurnal);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 Swal.fire('Data Berhasil Diupdate!','','success');
                }

            });
    })

    $('#btn-update-jk').on('click',function(){
        var id = $('#id2').val();
        var tgl_transaksi = $('#tgl_transaksi2').val();
        var kredit = $('#nominal2').val();
        var keterangan = $('#keterangan2').val();
        var pelaksana =  $('#pelaksana2').val();
        var des_coa  = $('#des_coa2').val();
        var group    = $('#group2').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/update_jk',
                async : false,
                data  : {id:id,tgl_transaksi:tgl_transaksi,kredit:kredit,keterangan:keterangan,pelaksana:pelaksana,des_coa:des_coa,group:group},
                dataType : 'json',
                success : function(data){
                    $('#edit-list').modal('hide');
                    var id_jurnal = $('#id_jurnal_perbaikan').val();
                 tampil_list_form_jurnal(id_jurnal);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });
    })



    $('#post_jurnal').on('click',function () {
        var id = $(this).attr('data');
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/cek_balance',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
                    if (data == true) {
                        post_jurnal(id);
                    }
                    else if(data == 'blank'){
                         Swal.fire('Masih Ada Data Yang Belum Diapprove!','','warning');
                    }
                    else
                    {
                        Swal.fire('Data Tidak Balance!','','warning');
                    }

                }

            });
    })

    function post_jurnal(id){
         $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/post_jurnal',
                async : false,
                data  : {id:id},
                dataType : 'json',
                success : function(data){
	                   tampil_buku_besar();
                   tampil_jurnal();
                   $('#tbl_buku_besar').DataTable({
                        scrollX:true,
                        retrieve: true
                     });
                  $('[href="#home"]').tab('show');
                  Swal.fire('Data Berhasil Disimpan!','','success');


                }

            });
    }

    $('#fil_coa').on('click', function () {
      i=$(this).find(':selected').attr('data-id')
    tables.columns(1).search(i).draw();
    });

     tampil_buku_besar();
     
     var tables = $('#tbl_buku_besar').DataTable({
                 dom: 'Bfrtip',
        buttons: [
            'copy',
             {
                extend: 'excelHtml5',
                title : 'Buku Besar',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 5, 6, 7 ]
                }
            }
        ],
            scrollX:true,
            responsive:true,
             "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$.]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 7 ).footer() ).html(
                'Rp'+number_format(pageTotal)+',00'
            );
        }
         });


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $($.fn.dataTable.tables(true)).DataTable()
           .columns.adjust()
           .responsive.recalc();
    })
    function tampil_buku_besar() {
        $.ajax({
                type  : 'ajax',
                url   : 'Jurnal_buku_besar/buku_besar',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        ];
                        const d = data[i].date_part;
                        var total_debit = Math.round(data[i].debtot);
                        var total_kredit =Math.round(data[i].kretot);
                        var saldo_awal = +data[i].saldo_awal+ +data[i].saldo_akhir_lm;
                        var saldo_akhir = +Math.round(saldo_awal)+ +total_debit+ - total_kredit;
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+data[i].no_coa_des+'</td>'+
                                '<td>'+data[i].deskripsi_coa+'</td>'+
                                '<td>'+monthNames[d-1]+'</td>'+
                                '<td>'+number_format(Math.round(saldo_awal))+'</td>'+
                                '<td>'+number_format(total_debit)+'</td>'+
                                '<td>'+number_format(total_kredit)+'</td>'+
                                '<td>'+number_format(saldo_akhir)+'</td>'+
                                '<td class="text-center">'+
                                    '<button  class="btn btn-info btn-xs j_detail" data-coa="'+data[i].no_coa_des+'"><i class="fa fa-file"></i></button>'+' '+
                                '</td>'+
                                '</tr>'
                    }
                    $('#show_bukbes').html(html);

                }
            });
    }


    $('#show_bukbes').on('click','.j_detail',function(){
          var id =  $(this).attr('data');
          var coa = $(this).data('coa');
					$.ajax({
						type  : 'post',
						url   : 'Jurnal_buku_besar/get_des_coa',
						dataType : 'json',
						data : {coa:coa},
						success : function(data){
							$('#coa_ex').val(coa);
							$('#des_coa_ex').val(data.deskripsi_coa);
							$('#tgl_trans_ex').val(data.tgl_transaksi);
							$('#h_dbb').text("COA - "+coa+" ("+data.deskripsi_coa+")");
		          detail_bb(id,coa);
		          $('#tbl_detail_bb').DataTable().clear().destroy();
		          $('[href="#detail_bb"]').tab('show');
						}
					})
        })

		// 	$('.export-btn').on('click',function() {
		// 		  var coa = $(this).attr('data');
		// 		$.ajax({
		// 						type  : 'post',
		// 						url   : 'Jurnal_buku_besar/excel',
		// 						dataType : 'json',
		// 						data : {coa:coa},
		// 						success : function(data){}
		// 	})
		// });
    function detail_bb(id,coa) {
        $.ajax({
                type  : 'post',
                url   : 'Jurnal_buku_besar/detail_bb',
                dataType : 'json',
                data : {id:id,coa:coa},
                success : function(data){
                    var saldo_akhir = +(data.sa) + +(data.sak);
                    $('#sac').text(number_format(Math.round(data.sa)));
                    $('#sak').text(number_format("Saldo Akhir :"+Math.round(saldo_akhir)));
                    var html ='';
                    for(i=0; i<data.det.length; i++){
                    var jumlah =  +(data.det[i].debit)+ +(-data.det[i].kredit);
                    html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+data.det[i].tgl_transaksi+'</td>'+
																'<td>'+data.det[i].group+'</td>'+
                                '<td width 300px;>'+data.det[i].keterangan+'</td>'+
                                '<td>'+number_format(Math.round(data.det[i].debit))+'</td>'+
                                '<td>'+number_format(Math.round(data.det[i].kredit))+'</td>'+
                                '<td>'+number_format(Math.round(jumlah))+'</td>'+
                                '</tr>'
                }
                 $('#data_detail_bb').html(html);
								 $('#fil_group').on('click', function () {
						 			i=$(this).find(':selected').attr('data')
						 		tabled.columns(2).search(i).draw();
						 		});

                 var tabled = $('#tbl_detail_bb').DataTable({
                    scrollX:true,
                    scrollY: "400px",
                    scrollCollapse: true,
                    paging: false,
                    info : false,
                    responsive:true,
                    footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$.]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( [5] )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    total = api
                    .column(4)
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column(5, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    pageTotalk = api
                        .column(4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Update footer
                    $( api.column( [5] ).footer() ).html(
                        number_format(pageTotal)
                    );
                    $( api.column( [4] ).footer() ).html(
                        number_format(pageTotalk)
                    );
                     $( api.column( [6] ).footer() ).html(
                        number_format(Math.round(saldo_akhir))
                    );
                },
                    })

             }
          })
    }




     $('#btn-filter-periode').on('click',function(){
        var periode = $('#fil_periode').val();
        $('#tbl_buku_besar').DataTable().clear().destroy();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/buku_besar',
                async : false,
                dataType : 'json',
                data : {periode:periode},
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data['bb'].length; i++){
                        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                          "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        ];
                        const d = data['bb'][i].date_part;

                        var total_debit = Math.round(data['bb'][i].debtot);
                        var total_kredit =Math.round(data['bb'][i].kretot);
                        var saldo_awal = +data['bb'][i].saldo_awal+ +data['bb'][i].saldo_akhir_lm;
                        var saldo_akhir = +Math.round(saldo_awal) + +total_debit - total_kredit;
                        html += '<tr>'+
                                '<td>'+(i+1)+'</td>'+
                                '<td>'+data['bb'][i].no_coa_des+'</td>'+
                                '<td>'+data['bb'][i].deskripsi_coa+'</td>'+
                                '<td>'+monthNames[d-1]+'</td>'+
                                '<td>'+number_format(Math.round(saldo_awal))+'</td>'+
                                '<td>'+number_format(total_debit)+'</td>'+
                                '<td>'+number_format(total_kredit)+'</td>'+
                                '<td>'+number_format(saldo_akhir)+'</td>'+
                                '<td class="text-center">'+
                                     '<button  class="btn btn-info btn-xs j_detail" data-coa="'+data['bb'][i].no_coa_des+'"><i class="fa fa-file"></i></button>'+' '+
                                '</td>'+
                                '</tr>'
                    }

                    $('#show_bukbes').html(html);
                    var tables = $('#tbl_buku_besar').DataTable({
                             dom: 'Bfrtip',
                    buttons: [
                        'copy',
                         {
                            extend: 'excelHtml5',
                            title : 'Buku Besar',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 5, 6, 7 ]
                            }
                        }
                    ],
                        scrollX:true,
                        responsive:true,
                         "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column( 7 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Total over this page
                        pageTotal = api
                            .column( 7, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        // Update footer
                        $( api.column( 7 ).footer() ).html(
                            'Rp'+number_format(pageTotal)+',00'
                        );
                    }
                     });
                            }

                        });
     });

    $('#btn-add-name-tr2').on('click',function () {
        var nama_tr = $('#nama_transaksi2').val();
        var id = $('#history_trans').val();
                $.ajax({
                type  : 'post',
                url   : 'Jurnal_buku_besar/add_jurnal',
                dataType : 'json',
                data : {nama_tr:nama_tr},
                success : function(data){
                for(i=0; i<data.length; i++){
                    var id_jurnal = data[i].id_jurnal;

                }
                tampil_jurnal();
                form_history(id,id_jurnal);
                form_historyk(id,id_jurnal);
                $('#id_jurnal').val(id_jurnal);
				$('#b_jurnal').attr('data',id_jurnal);
				$('#b_jurnalh').attr('data',id_jurnal);
                $('#id_jurnalk').val(id_jurnal);
                $('#add-name-jurnal').modal('hide');
                $('[href="#form_jurnal_history"]').tab('show');
                }
                });




    });

    function select_group() {

        $.ajax({
            type  : 'ajax',
            url   : 'Jurnal_buku_besar/get_group',
            async : false,
            dataType : 'json',
            success : function(data){
                var html ='';
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].id_group+'">'+data[i].group+'</option>'
                }
                $('.sel2g').html(html);
            }


        });
    }

    function select_pelaksana() {
        $.ajax({
            type  : 'ajax',
            url   : 'Jurnal_buku_besar/get_pelaksana',
            async : false,
            dataType : 'json',
            success : function(data){
                var html ='<option data-id="" ></option>';
                for(i=0; i<data.length; i++){
                    html += '<option value="'+data[i].id_anggota+'">'+data[i].nama_lengkap+'</option>'
                }
                $('.sel2ph').html(html);
            }


        });
    }

    function form_history(id,id_jurnal) {
        if (id > 0 ) {
            var id=id;
            var id_jurnal = id_jurnal;
        }
        else{
         var id= $('#id2').val();
        }

        $.ajax({
                type  : 'GET',
                url   : 'Jurnal_buku_besar/get_history',
                async : false,
                data : {id:id},
                dataType : 'json',
                success : function(data){

                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
                    var html = '';
                    var i;
                    var n = '1';
               for(i=0; i<data.length; i++ ){

                 html +=
                         '<div class="card text-white ">'+
                         '<div class="card-header bg-info">'+
                         '<h5 class="card-title">'+data[i].deskripsi_coa+'</h5>'+
                         '</div>'+
                         '<div class="card-body">'+'<form>'+
                         '<input type="hidden" class="id_jurnal" name="id_jurnal3" id="id_jurnal3'+n+'" value="'+id_jurnal+'">'+
                         '<input type="hidden" class="des_coa" name="des_coa" id="des_coa3'+n+'" value="'+data[i].coa+'">'+
                         '<div class="form-group">'+
                         '<select style="width:100%!important;" name="" id="grouphs3'+n+'" class="form-control sel2g group" required="required">'+
                         '</select>'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<input type="text" name="tgl_transaksi3" id="tgl_transaksi3'+n+'" class="form-control datepicker tgl_transaksi" required="required" title="" value="'+date+'">'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<input type="text"  name="nominal3" id="nominal3'+n+'" class="form-control"   placeholder="Nominal">'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<select style="width:100%!important;" name="pelaksana3" id="pelaksana3'+n+'" class="form-control sel2ph" required="required">'+
                         '</select>'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<textarea name="keterangan3" id="keterangan3'+n+'" class="form-control keterangan" rows="3" required="required"></textarea>'+
                         '</div>'+
                          '<button type="button" data="'+n+'" class="btn btn-info float-right save-hjd" id="save-hjd'+n+'">Simpan</button>'+
                         '</form>'+
                         '</div>'+
                         '</div>'
                        n++;
               }
               $('#show_history').html(html);
               $('.divide').divide({
                 delimiter: '.'
               });
                select_group();
								select_pelaksana();
               }
               });
    }

    function form_historyk(id,id_jurnal) {
        if (id > 0 ) {
            var id=id;
            var id_jurnal = id_jurnal;
        }
        else{
         var id= $('#id2').val();
        }
        $.ajax({
                type  : 'GET',
                url   : 'Jurnal_buku_besar/get_historyk',
                async : false,
                data : {id:id},
                dataType : 'json',
                success : function(data){
                    var today = new Date();
                    var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
                    var html = '';
                    var i;
               for(i=0; i<data.length; i++){
                n++;
                var n = '1';
                 html +=
                         '<div class="card text-white ">'+
                         '<div class="card-header bg-info">'+
                         '<h5 class="card-title">'+data[i].deskripsi_coa+'</h5>'+
                         '</div>'+
                         '<div class="card-body">'+'<form>'+
                         '<input type="hidden" class="id_jurnal" name="id_jurnalk" id="id_jurnalhk'+n+'" value="'+id_jurnal+'">'+
                         '<input type="hidden" class="" name="des_coa" id="des_coahk'+n+'" value="'+data[i].coa+'">'+
                         '<div class="form-group">'+
                         '<select style="width:100%!important;" name="" id="grouphk'+n+'" class="form-control sel2g" required="required">'+
                         '</select>'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<input type="text" name="tgl_transaksik" id="tgl_transaksihk'+n+'" class="form-control datepicker" required="required" title="" value="'+date+'">'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<input type="text" name="nominalk" id="nominalhk'+n+'" class="form-control " required="required" placeholder="Nominal">'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<select style="width:100%!important;" name="pelaksanak" id="pelaksanahk'+n+'" class="form-control sel2ph" required="required">'+
                         '</select>'+
                         '</div>'+
                         '<div class="form-group">'+
                         '<textarea name="keterangank" id="keteranganhk'+n+'" class="form-control" rows="3" required="required"></textarea>'+
                         '</div>'+
                         '<button type="button" data="'+n+'" class="btn btn-info float-right save-hjk" id="save-hjk'+n+'">Simpan</button>'+
                         '</form>'+
                         '</div>'+
                         '</div>'

               }
               $('#show_historyk').html(html);
               $('.divide').divide({
                 delimiter: '.'
               });
               select_group();
               select_pelaksana();
               }
               });
    }



       $('#show_history').on('click','.save-hjd',function(){
        var i = $(this).attr('data');
        var id = $('#id_jurnal3'+i).val();
        var group = $('#grouphs3'+i).val();
        var des_coa = $('#des_coa3'+i).val();
        var tgl_transaksi = $('#tgl_transaksi3'+i).val();
        var debit = $('#nominal3'+i).val();
        var keterangan = $('#keterangan3'+i).val();
        var pelaksana =  $('#pelaksana3'+i).val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jd',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,debit:debit,keterangan:keterangan,pelaksana:pelaksana,group:group},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnalh').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });
         });

     

    
        $('#show_historyk').on('click','.save-hjk',function(){
        var i = $(this).attr('data');
        var id = $('#id_jurnalhk'+i).val();
        var group = $ ('#grouphk'+i).val();
        var des_coa = $('#des_coahk'+i).val();
        var tgl_transaksi = $('#tgl_transaksihk'+i).val();
        var kredit = $('#nominalhk'+i).val();
        var keterangan = $('#keteranganhk'+i).val();
        var pelaksana =  $('#pelaksanahk'+i).val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jk',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,kredit:kredit,keterangan:keterangan,pelaksana:pelaksana,group:group},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnalh').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 $('#tgl_transaksihk'+i).val(tgl_transaksi);
                 $('#keteranganhk'+i).val(keterangan);
                 $("#pelaksanahk"+i).val(pelaksana).trigger('change');
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });
         })


    $('[href="#pembukuan"]').on('click',function() {
        
        //AKTIVA LANCAR
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_aktiva_lancar",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(Math.abs(data[i].saldo_akhir))+'</td>'+
                       '</tr>'
                }
                $('#tb_al').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_aktiva_lancar",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_al').text(number_format(Math.abs(data[0].saldo_akhir)));
                 $('#total_aktiva').text(number_format("Total : "+Math.abs(data[0].saldo_akhir)));
            }
        });

        //AKTIVA TETAP

         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_aktiva_tetap",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_at').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_aktiva_tetap",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_at').text(number_format(data[0].saldo_akhir));
            }
        });
        //PENDAPATAN
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_pendapatan",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_pdpt').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_pendapatan",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_pdpt').text(number_format(data[0].saldo_akhir));
            }
        });

         //PENDAPATAN LAIN-LAIN
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_pendapatan_lain",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_pdpt_lain').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_pendapatan_lain",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_pdpt_lain').text(number_format(data[0].saldo_akhir));
            }
        });

        //PENDAPATAN ALL
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_pendapatan_all",
            async: false,
            dataType: "json",
            success: function(data) {
                var total = +(data.pdpt[0].saldo_akhir)+ +(data.pdpt_lain[0].saldo_akhir)
                 $('#total_pdpt_all').text("Total Pendapatan  : "+number_format(total));
                 
                }
            
        });

        //BIAYA
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_biaya",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_pb').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_biaya",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_pb').text(number_format(data[0].saldo_akhir));
                 $('#total_pb_all').text("Total Biaya : "+number_format(data[0].saldo_akhir));
            }
        });


        //HUTANG
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_hutang",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_ph').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_hutang",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_ph').text(number_format(data[0].saldo_akhir));
            }
        });

        //LABA USAHA
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/laba_usaha",
            async: false,
            dataType: "json",
            success: function(data) {
               var total = +(data.pdpt[0].saldo_akhir)+ +(data.pdpt_lain[0].saldo_akhir)+ +(data.biaya[0].saldo_akhir)
                 $('#laba_usaha').text("Total Laba Usaha  : "+number_format(total));
            }
        });

         //TOTAL HUTANG MODAL
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_hm",
            async: false,
            dataType: "json",
            success: function(data) {
               var total = +(data.modal[0].saldo_akhir)+ +(data.hutang[0].saldo_akhir)
                 $('#total_hm').text("Total  : "+number_format(total));
            }
        });

         //LABA USAHA
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/neraca",
            async: false,
            dataType: "json",
            success: function(data) {
               if (data == 0 ) {
                $('#neraca_cek').text('Neraca Balance');
               }else{
                $('#neraca_cek').text('Neraca Tidak Balance');
               }
            }
        });

        //MODAL
         $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/get_modal",
            async: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;
                for(i=0; i<data.length; i++){
                html+= '<tr>'+
                       '<td>'+data[i].coa+'</td>'+
                       '<td>'+data[i].deskripsi_coa+'</td>'+
                       '<td>'+number_format(data[i].saldo_akhir)+'</td>'+
                       '</tr>'
                }
                $('#tb_pm').html(html);

            }
        });
        $.ajax({
            type : "ajax",
            url  : "Jurnal_buku_besar/total_modal",
            async: false,
            dataType: "json",
            success: function(data) {
                 $('#total_pm').text(number_format(data[0].saldo_akhir));
                 $('[href="#pembukuan"]').tab('show');
            }
        });

    });

		$('#btn-save-jdh').on('click',function(){
        var id = $('#id_jurnal').val();
        var group = $('#grouph').val();
        var des_coa = $('#des_coaph').val();
        var tgl_transaksi = $('#tgl_transaksiph').val();
        var debit = $('#nominalph').val();
        var keterangan = $('#keteranganph').val();
        var pelaksana =  $('#pelaksanaph').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jd',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,debit:debit,keterangan:keterangan,pelaksana:pelaksana,group:group},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 $('#tgl_transaksikh').val(tgl_transaksi);
                 $('#keterangankh').val(keterangan);
                 $("#pelaksanakh").val(pelaksana).trigger('change');
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }

            });
    })

		$('#btn-save-jkh').on('click',function(){
        var id = $('#id_jurnal').val();
        var group = $('#groupkh').val();
        var des_coa = $('#des_coakh').val();
        var tgl_transaksi = $('#tgl_transaksikh').val();
        var kredit = $('#nominalkh').val();
        var keterangan = $('#keterangankh').val();
        var pelaksana =  $('#pelaksanakh').val();
        $.ajax({
                type  : 'POST',
                url   : 'Jurnal_buku_besar/save_jk',
                async : false,
                data  : {id:id,des_coa:des_coa,tgl_transaksi:tgl_transaksi,kredit:kredit,keterangan:keterangan,pelaksana:pelaksana,groupk:group},
                dataType : 'json',
                success : function(data){
                 tampil_list_form_jurnal(id);
                 $('#tbl_list_form_jurnal').DataTable({
                    scrollX:true,
                    retrieve: true
                 });
                 Swal.fire('Data Berhasil Disimpan!','','success');
                }
            });

    })

        // $('#info_err_data').on('click',function(){
        //    $('.cari').val("Butuh Perbaikan"); 
        // })


     /*==============================
        =            cleave            =
        ==============================*/

        $('.divide').divide({
            delimiter: '.'
        });

        var cleave = new Cleave('.numb', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        var cleave = new Cleave('.numb1', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('.numb2', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('.numb3', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleave = new Cleave('.numb4', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        /*=====  End of cleave  ======*/

        

});

</script>