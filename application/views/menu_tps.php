<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if ($this->uri->segment(1) == "dashboard") {echo "class='active'";} ?>>
          <a href="<?php echo base_url() ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>           
          </a>          
        </li>        
        <li <?php if ($this->uri->segment(1) == "profile_tps") {echo "class='active'";} ?>>
          <a href="<?php echo base_url('profile_tps') ?>">
            <i class="fa fa-user"></i> <span>Profile</span>            
          </a>
        </li>        
        <li <?php if ($this->uri->segment(1) == "input") {echo "class='active'";} ?>>
          <a href="<?php echo base_url('input') ?>">
            <i class="fa fa-cloud-download"></i> <span>Input Suara</span>            
          </a>
        </li>
      </ul>