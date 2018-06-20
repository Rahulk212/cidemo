<!-- Page Heading -->
<section class="content-header">
    <h1>Category<small></small>
    </h1>
    <ol class="breadcrumb">
       
        <li><a href="<?php echo base_url(); ?>administrator/category_master/"><i class="fa fa-users"></i>Category List</a></li>
        <li class="active">Add Category</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
			<?= validation_errors('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                <form role="form" action="<?php echo base_url(); ?>category_master/add" method="post" enctype="multipart/form-data">
				
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Category Name</label><span style="color:red">*</span>
                                <input type="text"  name="name" class="form-control"  value="<?php echo set_value('name'); ?>" >
                                <span style="color: red;"><?= form_error('name'); ?></span>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Category icon</label><br>
                                <input type="file" id="exampleInputFile" name="categoryicon">
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Images</label><br>
                                <input type="file" id="exampleInputFile" name="userfile">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
