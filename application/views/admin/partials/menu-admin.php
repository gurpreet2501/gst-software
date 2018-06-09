<ul class="nav navbar-nav">
    <li class="active">
      <a href='<?php echo site_url('/dashboard/index')?>'>Dashboard</a> 
    </li>
   
        <li class="dropdown" id='data-management-menu'>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Billing<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url('/billing/create')?>'>Create Bill</a></li>
            <li><a href='<?php echo site_url('/data/previous_bills')?>'>Billing History</a></li>
          </ul>
        </li>
      
    <li class="dropdown" id='data-management-menu'>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Items Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=site_url('data/addTiles')?>">Add Item</a></li>
            <li><a href="<?=site_url('data/addCategory')?>">Add Item Category</a></li>
            <li><a href='<?php echo site_url('/data/addGstRates')?>'>Add Gst Rates</a></li>
          </ul>
        </li>
<?php /*

        <li class="dropdown" id='data-management-menu'>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bookings<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url('/billing/create')?>'>Create Pre Booking</a></li>
            <li><a href='<?php echo site_url('/data/pre_bookings')?>'>See Previous Bookings</a></li>
          </ul>
        </li>
    </ul> */

     ?>