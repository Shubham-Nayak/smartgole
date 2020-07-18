<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>   

				<!-- <footer class="footer-wrap-layout1">
                    <div class="copyright">© Copyrights  2019. All rights reserved</div>
                </footer>
                <input type="hidden" value="<?php// echo adminsbase_url();?>" id="adminsbase_url">
            </div>
        </div> -->
        
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="<?php echo adminassets_url('js/jquery-3.3.1.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/plugins.js');?>"></script>
    <script src="<?php echo adminassets_url('js/popper.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/jquery.scrollUp.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/main.js');?>"></script>
    <script src="<?php echo adminassets_url('js/select2.min.js');?>"></script>
    <script src="<?php echo adminassets_url('js/datepicker.min.js');?>"></script>
    <script src="https://colorlib.com/polygon/build/js/custom.min.js"></script>
    <script src="<?php echo adminassets_url('js/dropzone.min.js');?>"></script>
<script src="<?php echo adminassets_url('magnific-popup/js/magnific-popup.min.js');?>"></script>
	
    <script src="<?php echo adminassets_url('js/adminhelper.js');?>"></script>
	<script src="<?php echo base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
	<?php echo $this->tiny_mce_init; ?>
</body>
<script>
  $(document).ready(function(){
    //   alert('hi'); 
        $("#classroomtypeid").change(function () {
            var  classroomtypeid = $(this).val();
            
            // alert($class);
           var adminsbase_url = $('#adminsbase_url').val();
                    // AJAX request
            $.ajax({
                url: adminsbase_url+'dashboard/getclasstype',
                method: 'GET',
                data: {classroomtypeid: classroomtypeid},
                dataType: 'json',
                success: function(response){
                // Add options
                // console.log(response);
                if(response.status){
                    $('#classtype').html(response.message);
                }
                
                }
            });
            
        });            
    });

    $(document).ready(function(){ 
    //   alert('hi');
        $("#categoryid").change(function () {

            var  categoryid = $(this).val();
            var adminsbase_url = $('#adminsbase_url').val();
                    // AJAX request
            $.ajax({
                url: adminsbase_url+'dashboard/filterblog',
                method: 'GET',
                data: {categoryid: categoryid},
                dataType: 'json',
                success: function(response){
                // Add options
                // console.log(response);
                if(response.status){
                   $('#filterdata').html(response.message);
                   $('.filtediv').css({display:'block'});
                   $('.maindiv').hide();
                }
                
                }
            });
            
        });            
    });

</script>
</html>