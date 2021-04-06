<?php $this->load->view('backend/template/meta'); ?>
<div class="wrapper">

    <?php $this->load->view('backend/template/header'); ?>
    <?php $this->load->view('backend/template/sidebar'); ?>
        <?php echo $contents; ?>
    <?php $this->load->view('backend/template/footer'); ?>
</div>
<!-- ./wrapper -->
<?php $this->load->view('backend/template/script'); ?>
