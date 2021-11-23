<style>
    .asa {
        height: 500px;
        overflow-y: auto;
    }
</style>
<header id="topnav">
  <div class="topbar-main">
    <div class="ml-4 mr-4">
       <!-- Logo-->
       <div>
          <a href="<?= base_url() ?>" class="logo">
              <span class="logo-light">
                <img src="<?= base_url() ?>assets/img/logo.png" alt="" height="50">
              </span>
          </a>
      </div>
      <!-- End Logo-->
      <div class="menu-extras topbar-custom navbar p-0">
        <ul class="navbar-right ml-auto list-inline float-right mb-0">
          <!-- <li class="dropdown notification-list list-inline-item">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <span class="date-part"></span>&nbsp;~&nbsp;<span class="time-part"></span>
            </a>
          </li> -->
          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
              <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <span class="date-part"></span>&nbsp;~&nbsp;<span class="time-part"></span>
              </a>
          </li>
          <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
              <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url() ?>assets/template/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
              </a>
              <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle"></i> <?= wordwrap($this->session->userdata('nm_karyawan'),20,"<br>\n") ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="<?= base_url('Auth/out') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
              </div>
            </div>
          </li>
          <li class="menu-item dropdown notification-list list-inline-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="navbar-custom">
    <div class="ml-4 mr-4">
      <div id="navigation">
        <ul class="navigation-menu text-center">
            <?php echo menu_nav();?>
            <?php if ($this->uri->segment(1) == 'ajk') : ?>
            <a href="<?= base_url('dashboard') ?>"><button class="btn btn-primary ml-3">Home</button></a>
            <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</header>
