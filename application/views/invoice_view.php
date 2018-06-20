<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small></small>
        </h1>
        <ol class="breadcrumb">
           
            <li><i class="fa fa-users"></i>Invoice</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Users List</h3>
                        <a style="float:right;margin-right: 10px;" href='<?php echo base_url(); ?>administrator/users/add' class="btn btn-primary btn-sm" ><i class="fa fa-plus-circle" ></i><strong > Add</strong></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="widget">
                            <?php if ($this->session->flashdata('unsuccess')) { ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $this->session->flashdata('unsuccess'); ?>
                                </div>
                            <?php } ?>
							<?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>
                        </div>
					 <form role="form" action="<?php echo base_url(); ?>administrator/users/index/" method="get" enctype="multipart/form-data">
                         <div class="col-md-3">
                           <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $name1; ?>"/>
                        </div>
						
						<div class="col-md-2">
                           <input type="text" name="email" placeholder="email" class="form-control" value="<?php echo $email; ?>" />
                        </div>
						<div class="col-md-2">
                            <input type="text" name="mobile" placeholder="Mobile" class="form-control" value="<?php echo $mobile; ?>" />
                        </div>
						<div class="col-md-2">
                            <input type="text" name="county" placeholder="Country" class="form-control" value="<?php echo $this->input->get('county'); ?>" />
                        </div>
							<div class="col-md-2">
                           <input type="text" name="date" id="date" placeholder="Date" class="form-control" value="<?php echo $date; ?>" />
                        </div>
						
						<input type="submit" value="Search" class="btn btn-primary btn-md">
                        </form>
                        <br>
						
                        <div class="tableclass">
                           
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
											 <th>Country</th>
                                            <th>Date</th>
											<th>Verification Status</th>
                                            <th>Action/Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        <?php
                                        $cnt = 0;
                                        foreach ($query as $row) {
                                            $cnt++;
                                            ?>

                                            <tr>
                                                <td><?php echo $cnt+$page; ?></td>
                                                <td><?php echo ucwords($row->name); ?> </td>
                                                <td><?php echo $row->email; ?></td>
                                                <td><?php echo $row->mobile; ?></td>
												<td><?php echo $row->country_name; ?></td>
                                                <td><?php echo $row->created_date; ?></td>
												<td><?php if($row->active == '1'){ echo "Verified"; }else if($row->active == '2'){ echo "Deactived"; }else{  echo "Not Verified"; }?></td>
                                                <td>

                                                    <a href='<?php echo base_url(); ?>administrator/users/edit/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> 

                                                    <a  href='<?php echo base_url(); ?>administrator/users/delete/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are you sure you want to remove this data?');"><i class="fa fa-trash-o"></i></a>   
                                                    <?php if($row->status == '1'){ if ($row->active == "1") { ?>
                                                        <a  href='<?php echo base_url(); ?>administrator/users/deactive/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="Deactive" ><span class="label label-success">Active</span></a>
														
														<a  href="javascript:void(0);" data-toggle="modal" onclick="$('#getuserid').val(<?php echo $row->id; ?>); $('#myModal').modal('show'); " data-toggle="tooltip" data-original-title="Suspended" ><span class="label label-danger">Suspende</span> </a>
														
                                                    <?php }else{ ?> <a  href='<?php echo base_url(); ?>administrator/users/active/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="active" ><span class="label label-danger">Deactive</span> </a> <?php  } ?>
                                                    <?php }else{ if ($row->active == "2"){  ?>
													<a  href='<?php echo base_url(); ?>administrator/users/active/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="active" ><span class="label label-danger">Deactive</span> </a> 
													
													<?php }else{ ?> <a  href='<?php echo base_url(); ?>administrator/users/active/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="active" ><span class="label label-danger">Suspended</span> </a>   <?php } } ?>
													

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if ($cnt == '0') {
                                            ?>
                                            <tr>
                                                <td colspan="5">No records found</td>
                                            </tr>
                                        <?php }
                                        ?>

                                    </tbody>
                                </table>
                            
                        </div>
						      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="width:100%; float:left;">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Suspende User</h4>
                    </div>
                    <div class="modal-body" >
<form role="form" action="<?= base_url()."administrator/users/suspende"; ?>" id="suspendsform" method="POST" accept-charset="utf-8" >
                  <div class="form-group">
                    <label for="exampleInputEmail1">Remark :</label>
                      <textarea required name="remark" id="userremark" placeholder="Enter Remark" type="text" class="form-control "></textarea>
					  <div class="error" id="usersuspremrk" style="color:red;"></div>
                  </div>
       
                  <button type="submit" class="btn btn-default">Submit</button>
				   <input type="hidden" name="userid" id="getuserid" value="" >
                </form>
               
               

                    </div>
                </div>
            </div>
						
                        <div style="text-align:right;" class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <?php echo $links; ?>
                            </ul>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'dd/mm/yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			
		})
	});
	$( "#suspendsform" ).submit(function( event ) {
		 $("#usersuspremrk").html("");
		var remrk=$("#userremark").val();
		var remrk1=remrk.trim();
	if(remrk1 == ""){ $("#usersuspremrk").html("The Remrk field is required."); event.preventDefault();  }
  
});
</script>
<script type="text/javascript">
	window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>
