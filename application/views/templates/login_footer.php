<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/login/')?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/login/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/login/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/login/')?>js/sb-admin-2.min.js"></script>

	<script src="<?php echo base_url('assets/login/')?>package/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1000);
    });    
</script>
	
</body>

</html>
