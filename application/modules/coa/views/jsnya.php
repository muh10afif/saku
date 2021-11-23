<script type="text/javascript">

    $(document).ready(function() {

        $('.acc_head').on('click', function () {

            var no_coa_head = $(this).attr('no_coa_head');

            $('.acc_head_content').attr('hidden', true);

            $('#v-pills-tabContent'+no_coa_head).attr('hidden', false);
            
        })


    /*================================
    =            Pengguna            =
    ================================*/
        tampil_data_pengguna();
        $('#pengguna').DataTable({
            scrollX:true,
        });
        //fungsi tampil barang
            function tampil_data_pengguna(){
                $.ajax({
                    type  : 'ajax',
                    url   : 'Auth/json',
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<tr>'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+data[i].nama_lengkap+'</td>'+
                                    '<td>'+data[i].username+'</td>'+
                                    '<td>'+data[i].level+'</td>'+
                                    '<td class="text-center">'+
                                        // '<button  class="btn btn-info btn-xs item_edit" data="'+data[i].id_pengguna+'"><i class="fa fa-edit"></i></button>'+' '+
                                        '<button " class="btn btn-danger btn-xs item_hapus" data="'+data[i].id_pengguna+'"><i class="fa fa-trash"></i></button>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_data').html(html);
                    }

                });
            }

            //GET UPDATE
            $('#show_data').on('click','.item_edit',function(){
                var id_pengguna=$(this).attr('data');
                $.ajax({
                    type : "GET",
                    url  : "Auth/edit_pengguna",
                    dataType : "JSON",
                    data : {id_pengguna:id_pengguna},
                    success: function(data){
                        $.each(data,function(id_pengguna, nama_lengkap, username, password, level, status){
                            $('#ModalEdit').modal('show');
                            $('[name="id_pengguna_edit"]').val(data.id_pengguna);
                            $('[name="nama_lengkap_edit"]').val(data.nama_lengkap);
                            $('[name="username_edit"]').val(data.username);
                            $('[name="password_edit"]').val(data.password);
                            $('[name="level_edit"]').val(data.level);
                            $('[name="status_edit"]').val(data.status);
                        });
                    }
                });
                return false;
            });
            //GET HAPUS
            $('#show_data').on('click','.item_hapus',function(){
                var id_pengguna=$(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="id_pengguna"]').val(id_pengguna);
            });

            //button-simoan
            $('#btn_simpan').on('click',function(){
                var nama_lengkap=$('#nama').val();
                var username=$('#username').val();
                var password=$('#password').val();
                var level=$('#level').val();
                var status=$('#status').val();
                $.ajax({
                    type : "POST",
                    url  : "Auth/register_proses",
                    dataType : "JSON",
                    data : {nama_lengkap:nama_lengkap , username:username, password:password,level:level,status:status},
                    success: function(data){
                        $('[name="nama"]').val("");
                        $('[name="username"]').val("");
                        $('[name="password"]').val("");
                        $('[name="level"]').val("");
                        $('[name="status"]').val("");
                        $('#modal-add').modal('hide');
                        tampil_data_pengguna();
                        Swal.fire('Data Berhasil Disimpan!','','success');
                    }
                });
                return false;
            });

            //Hapus Barang
            $('#btn_hapus').on('click',function(){
                var id_pengguna=$('#id').val();
                $.ajax({
                type : "POST",
                url  : "Auth/hapus_pengguna",
                dataType : "JSON",
                        data : {id_pengguna: id_pengguna},
                        success: function(data){
                                $('#ModalHapus').modal('hide');
                                Swal.fire('Data Berhasil Dihapus!','','success');
                                tampil_data_pengguna();
                        }
                    });
                    return false;
                });

            //Update Barang
            $('#btn_update').on('click',function(){
                var id_pengguna=$('#id_pengguna').val();
                var nama_lengkap=$('#nama2').val();
                var username=$('#username2').val();
                var level=$('#level2').val();
                var status=$('#status2').val();
                $.ajax({
                    type : "POST",
                    url  : "Auth/update_pengguna",
                    dataType : "JSON",
                    data : {id_pengguna:id_pengguna, nama_lengkap:nama_lengkap , username:username, level:level, status:status},
                    success: function(data){
                        $('[name="nama_lengkap"]').val("");
                        $('[name="username"]').val("");
                        $('[name="level"]').val("");
                        $('[name="status"]').val("");
                        $('#ModalEdit').modal('hide');
                        tampil_data_pengguna();
                        Swal.fire('Data Berhasil Diupdate!','','success');
                    }
                });
                return false;
            });
    });

    /*=====  End of Pengguna  ======*/

    /*==============================
    =            head COA   =
    ==============================*/

    $(document).ready(function() {
        tampil_head_coa();
        $('#tbl_head_coa').DataTable({
            scrollX:true,
        });
        //fungsi tampil barang
            function tampil_head_coa(){
                $.ajax({
                    type  : 'ajax',
                    url   : 'Head_coa/json',
                    async : false,
                    dataType : 'json',
                    success : function(data){
                        var html = '';
                        var i;

                        for(i=0; i<data.length; i++){
                            if (data[i].neraca_lr = '0') {
                                var neraca_lr = "neraca"
                            }
                            else
                                {
                                    var neraca_lr = "Laba Rugi"
                                }
                            ;
                            html += '<tr>'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+data[i].no_coa_head+'</td>'+
                                    '<td>'+data[i].head_coa+'</td>'+
                                    '<td>'+neraca_lr+'</td>'+
                                    '<td class="text-center">'+
                                        '<button  class="btn btn-info btn-xs hc_edit" data="'+data[i].id_head_coa+'"><i class="fa fa-edit"></i></button>'+' '+
                                        '<button " class="btn btn-danger btn-xs hc_hapus" data="'+data[i].id_head_coa+'"><i class="fa fa-trash"></i></button>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_head_coa').html(html);
                    }

                });
            };

            $('#btnadd').on("click",function () {
                $('#title_add').show();
                $('#title_edit').hide();
                $('#btn_update_hc').hide();
                $('#btn_simpan_hc').show();
                $('#no_coa_head').val("");
                $('#head_coa').val("");
                $('#neraca_lr').val("");


            })

            //GET UPDATE
            $('#show_head_coa').on('click','.hc_edit',function(){
                var id_head_coa=$(this).attr('data');
                $.ajax({
                    type : "GET",
                    url  : "Head_coa/edit",
                    dataType : "JSON",
                    data : {id_head_coa:id_head_coa},
                    success: function(data){
                        $.each(data,function(id_head_coa, no_coa_head, head_coa, neraca_lr){
                            $('#title_add').hide();
                            $('#title_edit').show();
                            $('#btn_simpan_hc').hide();
                            $('#btn_update_hc').show();
                            $('#modal-add').modal('show');
                            $('[name="id_head_coa"]').val(data.id_head_coa);
                            $('[name="no_coa_head"]').val(data.no_coa_head);
                            $('[name="head_coa"]').val(data.head_coa);
                            $('[name="neraca_lr"]').val(data.neraca_lr);
                        });
                    }
                });
                return false;
            });

            //GET HAPUS
            $('#show_head_coa').on('click','.hc_hapus',function(){
                var id_head_coa=$(this).attr('data');
                $('#ModalHapus').modal('show');
                $('[name="id_head_coa"]').val(id_head_coa);
            });

            //button-simpan
            $('#btn_simpan_hc').on('click',function(){
                var no_coa_head=$('#no_coa_head').val();
                var head_coa=$('#head_coa').val();
                var neraca_lr=$('#neraca_lr').val();
                $.ajax({
                    type : "POST",
                    url  : "Head_coa/simpan",
                    dataType : "JSON",
                    data : {no_coa_head:no_coa_head , head_coa:head_coa, neraca_lr:neraca_lr},
                    success: function(data){
                        $('[name="no_coa_head"]').val("");
                        $('[name="head_coa"]').val("");
                        $('[name="neraca_lr"]').val("");
                        $('#modal-add').modal('hide');
                        Swal.fire('Data Berhasil Disimpan!','','success');
                    }
                });
                return false;
            });

            //Hapus
            $('#btn_hapus_hc').on('click',function(){
                var id_head_coa =$('#id').val();
                $.ajax({
                type : "POST",
                url  : "Head_coa/hapus",
                dataType : "JSON",
                        data : {id_head_coa: id_head_coa},
                        success: function(data){
                                $('#ModalHapus').modal('hide');
                                Swal.fire('Data Berhasil Dihapus!','','success');
                                tampil_head_coa();
                        }
                    });
                    return false;
                });

            //Update
            $('#btn_update_hc').on('click',function(){
                var id_head_coa=$('#id_head_coa').val();
                var no_coa_head=$('#no_coa_head').val();
                var head_coa=$('#head_coa').val();
                var neraca_lr=$('#neraca_lr').val();
                $.ajax({
                    type : "POST",
                    url  : "Head_coa/update",
                    dataType : "JSON",
                    data : {id_head_coa:id_head_coa, no_coa_head:no_coa_head , head_coa:head_coa, neraca_lr:neraca_lr},
                    success: function(data){
                        $('[name="nama_lengkap"]').val("");
                        $('[name="username"]').val("");
                        $('[name="level"]').val("");
                        $('[name="status"]').val("");
                        $('#modal-add').modal('hide');
                        tampil_head_coa();
                        Swal.fire('Data Berhasil Diupdate!','','success');
                    }
                });
                return false;
            });

            tampil_group();
            $('#tbl_group').DataTable({
            scrollX:true,
        });

            function tampil_group() {
                $.ajax({
                    type  :"ajax",
                    url : "Group/json",
                    async : false,
                    dataType : "json",
                    success: function(data) {
                            var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<tr>'+
                                    '<td>'+(i+1)+'</td>'+
                                    '<td>'+data[i].no_group+'</td>'+
                                    '<td>'+data[i].group+'</td>'+
                                    '<td class="text-center">'+
                                        '<button  class="btn btn-info btn-xs g_edit" data="'+data[i].id_group+'"><i class="fa fa-edit"></i></button>'+' '+
                                        '<button " class="btn btn-danger btn-xs g_hapus" data="'+data[i].id_group+'"><i class="fa fa-trash"></i></button>'+
                                    '</td>'+
                                    '</tr>';
                        }
                        $('#show_group').html(html);
                    }


                });
            }

            $('#btn-modal').on('click',function() {
                $('#tambah').show();
                $('#edit').hide();
                $('#simpan').show();
                $('#update').hide();
                $('#modal').modal('show');
            });

            $('#simpan').on('click',function() {
                var no_group = $('#no_group').val();
                var group = $('#group').val();
                $.ajax({
                    type  :"POST",
                    url : "Group/simpan",
                    async : false,
                    data  : {no_group:no_group,group:group},
                    dataType : "json",
                    success: function(data) {
                        tampil_group();
                        $('#modal').modal('hide');
                        Swal.fire('Data Berhasil Disimpan!','','success');
                    }
                })

            });


            $('#show_group').on('click','.g_hapus',function() {
                var id = $(this).attr('data');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang telah di hapus tidak dapat kembali",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                    }).then((result) => {
                    if (result.value) {
                        $.ajax({
                        type : "POST",
                        url  : "Group/hapus",
                        data : {id:id},
                        dataType: "json",
                        success: function(data) {
                        tampil_group();
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )

                    }
                });
                    }
                    })

            })

    $('#show_group').on('click','.g_edit',function() {
                var id = $(this).attr('data');
                $.ajax({
                        type : "GET",
                        url  : "Group/edit",
                        data : {id:id},
                        dataType: "json",
                        success: function(data) {
                        for(i=0; i<data.length; i++){
                            $('#id').val(data[i].id_group);
                            $('#no_group').val(data[i].no_group);
                            $('#group').val(data[i].group);
                            $('#tambah').hide();
                            $('#edit').show();
                            $('#simpan').hide();
                            $('#update').show();
                            $('#modal').modal('show');
                        }
                    }
                    });
            })

    $('#update').on('click',function() {
                var id =  $('#id').val();
                var no_group = $('#no_group').val();
                var group = $('#group').val();
                $.ajax({
                    type  :"POST",
                    url : "Group/update",
                    async : false,
                    data  : {id:id,no_group:no_group,group:group},
                    dataType : "json",
                    success: function(data) {
                        tampil_group();
                        $('#modal').modal('hide');
                        Swal.fire('Data Berhasil Diupdate!','','success');
                    }
                })

            });


        $('#import').submit,function(e) {
            e.preventDefault();
            $.ajax({
                type : "POST",
                url  : "Head_coa/import_truncate",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){
                Swal.fire('Data Berhasil Di import!','','success');
            }
            });
        }

    });


    // function confirmation(ev) {
    // ev.preventDefault();
    // var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
    // console.log(urlToRedirect); // verify if this is the right URL
    // swal({
    //   title: "Are you sure?",
    //   text: "Once deleted, you will not be able to recover this imaginary file!",
    //   icon: "warning",
    //   buttons: true,
    //   dangerMode: true,
    // })
    // .then((willDelete) => {
    //   // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
    //   if (willDelete) {
    //     swal("Poof! Your imaginary file has been deleted!", {
    //       icon: "success",
    //     });
    //   } else {
    //     swal("Your imaginary file is safe!");
    //   }
    // });
    // }


    /*=====  End of master head COA ======*/

    $(document).ready(function() {

    for ( i = 1; i < 24; i++) {

        $('#coa_ner'+i).DataTable({
            scrollX:true,
            bFilter : true,
            bLengthChange: false,
            order: [[ 1, "asc" ]],
            scrollY: "300px",
            scrollCollapse: true,
            paging: true,
            bInfo : true,
            responsive: true
        });

        $('#coa_lr'+i).DataTable({
            scrollX:true,
            bFilter : true,
            bLengthChange: false,
            order: [[ 1, "asc" ]],
            scrollY: "300px",
            scrollCollapse: true,
            paging: true,
            bInfo : true,
            responsive: true

        });
    }

    $('.tabel_main_coa').DataTable({
        // scrollX:true,
        bFilter : true,
        // bLengthChange: false,
        order: [[ 1, "asc" ]],
        // scrollY: "300px",
        scrollCollapse: true,
        paging: true,
        bInfo : true,
        responsive: true
    });


    $('a[href="#menu1"]').one('click',function(){
        setTimeout(function(){
            for ( i = 1; i < 4; i++) {
            $('#coa_ner'+i).DataTable({
            scrollX:true,
            bFilter : false,
            bLengthChange: false,
            scrollY: "170px",
            scrollCollapse: true,
            paging: false,
            bInfo : false,
            responsive: true

        });
            }
        },0);
    });

    $('#tbl_k').DataTable({
    bLengthChange: false,
        });


    $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
            });

    $(".datepickers").datepicker( {
        format: "MM",
        startView: "months",
        minViewMode: "months"
    });

    $(".datepicker1").datepicker( {
        format: "m",
        startView: "months",
        minViewMode: "months"
    });

    $("#main_coa").chained("#head_coa");
    $("#des_coa").chained("#main_coa");
    $("#main_coa2").chained("#head_coa2");
    $("#des_coa2").chained("#main_coa2");
    $("#main_coak").chained("#head_coak");
    $("#des_coak").chained("#main_coak");
    $("#des_coakh").chained("#main_coakh");
    $("#main_coakh").chained("#head_coakh");
    $("#main_coaph").chained("#head_coaph");
    $("#des_coaph").chained("#main_coaph");

    // select2
    $('.sel2').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Head COA"

    });

    $('.sel2g').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Group"

    });

    $('.sel2m').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Main COA"

    });

    $('.sel2d').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Description COA"
    });

    $('.sel2p').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Pelaksana"
    });

    $('.sel2ph').select2({
        theme: "bootstrap4",
        placeholder: "Pilih Pelaksana"
    });

    $('.sel2dc').select2({
        theme: "bootstrap4",
        placeholder: "Pilih COA"
    });

    });


</script>