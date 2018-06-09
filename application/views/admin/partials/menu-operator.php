<ul class="nav navbar-nav">
    <li class="active">
      <a href='<?php echo site_url('/operator/dashboard')?>'>Dashboard</a> 
    </li>
    <li class="active" id="gate-entry-menu">
      <a href='<?php echo site_url('/gate_pass/index')?>'>Gate Entry</a> 
    </li>
    <li class="dropdown" id='data-management-menu'>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('data/accounts')?>">Accounts</a></li>
            <li><a href="<?=site_url('data/stockGroups')?>">Stock Groups</a></li>
            <li><a href="<?=site_url('data/stockItems')?>">Stock Items</a></li>
            <li><a href="<?=site_url('data/bagTypes')?>">Bag Types</a></li>
            <li><a href="<?=site_url('data/qualityCutTypes')?>">Quality Cut Types</a></li>
            <li><a href="<?=site_url('data/forms')?>">Forms</a></li>
          </ul>
        </li>
    </ul>