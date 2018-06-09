<?php $this->load->view('admin/partials/header');?>
<div class="row">
<div class="col-xs-4"></div>
<div class="col-xs-4">
  <a class="no-print" href="<?=site_url('billing/print_bill/'.$bill_id)?>"><button type="button" class="btn btn-danger">Print Bill</button></a>
</div>
</div>
<?php $this->load->view('admin/partials/footer');?>
