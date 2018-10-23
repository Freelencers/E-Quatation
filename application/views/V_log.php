<style>
  pre{
    width: 100%;
    height: 700px; 
    table-layout:fixed;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <pre>
      <?php
        foreach($log as $row){

          echo $row->log_date . " " . $row->log_msg . " by " . $row->emp_first_name . " " . $row->emp_last_name . "<BR>";
        }
      ?>
    </pre>
  </div>
</div> 


<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('/assert/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assert/plugins/iCheck/icheck.min.js'); ?>"></script>
<?php
  echo script_tag("js/project_mm.js");
?>
