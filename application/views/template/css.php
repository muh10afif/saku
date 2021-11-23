<!-- DataTables -->
<link href="<?= base_url() ?>assets/template/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/template/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="<?= base_url() ?>assets/template/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Plugins datepicker -->
<link href="<?= base_url() ?>assets/template/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/template/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="<?= base_url() ?>assets/template/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

<!-- Summernote css -->
<link href="<?= base_url() ?>assets/template/plugins/summernote/summernote-bs4.css" rel="stylesheet" />

<!-- select2 -->
<link href="<?= base_url() ?>assets/select2/select2.min.css" rel="stylesheet"/>
<link href="<?= base_url() ?>assets/select2/select2-bootstrap4.min.css" rel="stylesheet"/>

<link href="<?= base_url() ?>assets/template/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>assets/signature/css/jquery.signature.css" rel="stylesheet" type="text/css">

<!-- <link rel="stylesheet" href="<?= base_url() ?>assets/signature_pad/css/signature-pad.css"> -->

<link href="<?= base_url() ?>assets/template/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>assets/template/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>assets/template/assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>assets/template/assets/css/style.css" rel="stylesheet" type="text/css">

<style>
.select2-container--bootstrap4 .select2-results__option--highlighted, .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected=true] {
    background-color: #006c45;
    color: #f8f9fa;
}
.btn-primary.disabled, .btn-primary:disabled {
    color: #fff;
    background-color: #006c45;
    border-color: #006c45;
}

.custom-control-label::before {
    top: .25rem;
}
/* .custom-switch .custom-control-label::after {
    top: calc(.10rem + 2px);
} */
div.dataTables_wrapper div.dataTables_length select {
    width: 65px;
    display: inline-block;
}
.custom-control-label::before {
    border: #006c45 solid 1px;
}

#topnav .navigation-menu > li > a {
    color: black;
}
#topnav .navigation-menu > li .submenu li a {
    color: black;
}
</style>

<style>
.sel2 .parsley-errors-list.filled {
margin-top: 42px;
margin-bottom: -60px;
}

.sel2 .parsley-errors-list:not(.filled) {
display: none;
}

.sel2 .parsley-errors-list.filled + span.select2 {
margin-bottom: 30px;
}

.sel2 .parsley-errors-list.filled + span.select2 span.select2-selection--single {
    background: #FAEDEC !important;
    border: 1px solid #E85445;
}
</style>

<style>
    div.dataTables_wrapper .container-fluid {
        margin: 0 auto;
    }
</style>

<style>
    .datepicker table tr td span.focused, .datepicker table tr td span:hover {
        background: #006c45;
        color: white;
    }

    .datepicker table tr td span.active, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active:hover {
        background-color: #006dcc;
        background-image: -moz-linear-gradient(to bottom,#006c45,#006c45);
        background-image: -ms-linear-gradient(to bottom,#006c45,#006c45);
        background-image: -webkit-gradient(linear,0 0,0 100%,from(#006c45),to(#006c45));
        background-image: -webkit-linear-gradient(to bottom,#006c45,#006c45);
        background-image: -o-linear-gradient(to bottom,#006c45,#006c45);
        background-image: linear-gradient(to bottom,#006c45,#006c45);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#006c45', endColorstr='#006c45', GradientType=0);
        border-color: #04c #04c #002a80;
        border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
        filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
        color: #fff;
        text-shadow: 0 -1px 0 rgba(0,0,0,.25);
    }
</style>