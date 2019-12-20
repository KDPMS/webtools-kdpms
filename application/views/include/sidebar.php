<nav class="sidebar sidebar-offcanvas" id="sidebar" style="display:none;">
  <ul class="nav" style="position: fixed;">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image ">
            <img src="<?php echo $this->session->userdata('foto'); ?>" class="img-xs rounded-circle" alt="profile image">
          </div>
          <div class="text-wrapper">
            <a href="<?php echo base_url('User/Account/'.$this->session->userdata('id')) ?>"><p class="profile-name"><?php echo $this->session->userdata('username'); ?></p></a>
            <div>
              <small class="designation text-muted"><?php echo $this->session->userdata('jabatan'); ?></small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>
        <a href="<?= base_url('tools'); ?>" class="btn btn-primary btn-block"><i class="mdi mdi-back"></i>Menu Tools</a>
        <a href="<?php echo base_url('Login/Logout'); ?>" class="btn btn-danger btn-block"><i class="mdi mdi-keyboard-arrow-left"></i> Keluar
        </a>

      </div>
    </li>
    <div style="width:104%;height:400px;overflow: auto;">
	    <li class="nav-item">
	      <a class="nav-link" href="javascript:void(0)" id="dashboard">
	        <i class="menu-icon mdi mdi-television"></i>
	        <span class="menu-title">Dashboard</span>
	      </a>
	    </li>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager' OR $this->session->userdata('jabatan') == 'marketing') { ?>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="dataNasabah">
		        <i class="menu-icon mdi mdi-account-circle"></i>
		        <span class="menu-title">Calon nasabah</span>
		      </a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="dataAplikasiOrder">
		        <i class="menu-icon mdi mdi-shopping"></i>
		        <span class="menu-title">Aplikasi Order</span>
		      </a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="TrackingOrder">
		        <i class="menu-icon mdi mdi-chart-arc"></i>
		        <span class="menu-title">Tracking Order</span>
		      </a>
		    </li>
	    <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager' OR $this->session->userdata('jabatan') == 'teller' OR $this->session->userdata('jabatan') == 'TELLER') { ?>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="KreditChecking">
		        <i class="menu-icon mdi mdi-credit-card"></i>
		        <span class="menu-title">Kredit Checking</span>
		      </a>
		    </li>
	    <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager') { ?>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="SurveyKomite">
		        <i class="menu-icon mdi mdi-clipboard-check"></i>
		        <span class="menu-title">Survey Komite</span>
		      </a>
		    </li>
	    <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager' OR $this->session->userdata('jabatan') == 'marketing') { ?>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="MemoKreditAo">
		        <i class="menu-icon mdi mdi-account-card-details"></i>
		        <span class="menu-title">Memo Kredit AO</span>
		      </a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="MemoKreditCa">
		        <i class="menu-icon mdi mdi-account-check"></i>
		        <span class="menu-title">Memo Kredit CA</span>
		      </a>
		    </li>
	    <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager') { ?>
        <li class="nav-item">
          <a class="nav-link" href="javascript:void(0)" id="caa">
            <i class="menu-icon mdi mdi-pocket"></i>
            <span class="menu-title">Persetujuan</span>
          </a>
        </li>
      <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager' OR $this->session->userdata('jabatan') == 'legal' OR $this->session->userdata('jabatan') == 'LEGAL') { ?>
		    <li class="nav-item">
	        <a class="nav-link" href="javascript:void(0)" id="Legal">
	          <i class="menu-icon mdi mdi-checkbox-marked-circle-outline"></i>
	          <span class="menu-title">Legal</span>
	        </a>
	      </li>
      <?php } ?>
	    <?php if ($this->session->userdata('jabatan') == 'ketua' OR $this->session->userdata('jabatan') ==  'manager' OR $this->session->userdata('jabatan') == 'teller' OR $this->session->userdata('jabatan') == 'TELLER') { ?>
	      <li class="nav-item">
		      <a class="nav-link" href="javascript:void(0)" id="OfferingLatter">
		        <i class="menu-icon mdi mdi-newspaper"></i>
		        <span class="menu-title">Offering Latter</span>
		      </a>
		    </li>
	    <?php } ?>
	    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Login/Logout'); ?>">
          <i class="menu-icon mdi mdi-power-off"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>
	    <br><br><br>
		</div>
    <!--<li class="nav-item">
      <a class="nav-link" href="pages/charts/chartjs.html">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">Charts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/tables/basic-table.html">
        <i class="menu-icon mdi mdi-table"></i>
        <span class="menu-title">Tables</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="pages/icons/font-awesome.html">
        <i class="menu-icon mdi mdi-sticker"></i>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon mdi mdi-restart"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/login.html"> Login </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/register.html"> Register </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
          </li>
        </ul>
      </div>
    </li> -->
  </ul>
</nav>
