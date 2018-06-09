<ul class="nav navbar-nav">
    <li class="active">
      <a href='<?php echo site_url('/manager/dashboard')?>'>Dashboard</a> 
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
            <li><a href="<?=site_url('manager/formCreate')?>">Forms Create</a></li>
          </ul>
        </li>

         <li class="dropdown" id="manager-dashboard-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manager Dashboard<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('manager_dashboard/cash_transaction')?>">Cash Transaction</a></li>
            <li><a href="<?=site_url('manager_dashboard/cmr_rice_quality_report')?>">CMR Rice Quality Report</a></li>
            <li><a href="<?=site_url('manager_dashboard/bran_quality_report')?>">Bran Quality Report</a></li>
          </ul>
        </li>


        <li class="dropdown-submenu"  id="settings-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings</a>
            <ul class="dropdown-menu">
                <li class="dropdown-submenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gate Entry</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="<?=site_url('settings/gate_entry/material/IN')?>" class="dropdown-toggle" >Material In</a>
                            <a href="<?=site_url('settings/gate_entry/material/OUT')?>" class="dropdown-toggle">Material Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            </li>
    </ul>