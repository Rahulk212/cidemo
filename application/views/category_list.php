<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Category<small></small>
        </h1>
        <ol class="breadcrumb">
           
            <li><i class="fa fa-users"></i>Category</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category List</h3>
                        <a style="float:right;" href='<?php echo base_url(); ?>category_master/add' class="btn btn-primary btn-sm" ><i class="fa fa-plus-circle" ></i><strong > Add</strong></a>
                        <!--<a style="float:right;" href='<?php echo base_url(); ?>test_master/test_csv' class="btn btn-primary btn-sm" ><strong > Export</strong></a>
                        <a style="float:right;" data-toggle="modal"  data-target="#import"  class="btn btn-primary btn-sm" ><strong > Import</strong></a>-->
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
                        </div> <?php /*
                        <?php $attributes = array('class' => 'form-horizontal', 'method' => 'get', 'role' => 'form'); ?>
                        <?php echo form_open('administrator/category_master/index', $attributes); ?>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="search" placeholder="search" value="<?php if (isset($search) != NULL) {
                            echo $search;
                        } ?>" />
                        </div>
                        <input type="submit" value="Search" class="btn btn-primary btn-md">
                        </form> */ ?>
                        <br> 
                        <div class="tableclass">
                            <table id="sort" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Test Name</th>
										
										<th>Created Date Time</th>
										<th>Updated Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$cnt = $counts;
foreach ($query as $row) {
    $cnt++;
    ?>
                                        <tr id="list_<?= $row->id; ?>">
                                            <td><?php echo ucwords($row->name); ?></td>
											
											<td><?=  $row->created_date; ?></td>
											<td><?php echo $row->updated_date; ?></td>
                                            <td><a href='<?php echo base_url(); ?>category_master/edit/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> 
                                                <a  href='<?php echo base_url(); ?>category_master/delete/<?php echo $row->id; ?>' data-toggle="tooltip" data-original-title="Remove" onclick="return confirm('Are you sure you want to remove this data?');"><i class="fa fa-trash-o"></i></a>      
                                            </td>
                                        </tr>
    <?php }if (empty($query)) {
    ?>
                                        <tr>
                                            <td colspan="4">No records found</td>
                                        </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
						 <div id="info"></div> 
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

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
 $('#sort tbody').sortable({update : function () {
	 	var order = $('#sort tbody').sortable('serialize');
    		 $("#info").load("<?php echo base_url(); ?>category_master/set_categoriesget?"+order);
 }});
</script>