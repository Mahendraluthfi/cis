<ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if ($this->uri->segment(1) == "dashboard") {echo "class='active'";} ?>>
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            
          </a>          
        </li>        
        <li <?php if ($this->uri->segment(1) == "profile") {echo "class='active'";} ?>>        
          <a href="<?php echo base_url('profile') ?>">
            <i class="fa fa-users"></i> <span>Profile</span>            
          </a>
        </li>        
        <li <?php if ($this->uri->segment(1) == "tps") {echo "class='active'";} ?>>
          <a href="<?php echo base_url('tps') ?>">
            <i class="fa fa-th"></i> <span>TPS</span>            
          </a>
        </li>    
        <li <?php if ($this->uri->segment(1) == "report") {echo "class='active'";} ?>>
          <a href="<?php echo base_url('report') ?>">
            <i class="fa fa-file"></i> <span>Report</span>            
          </a>
        </li>        
      </ul>