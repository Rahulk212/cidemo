<!-- Page Heading -->

<section class="content-header">
    <h1>Category<small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>category_master/"><i class="fa fa-users"></i>Category List</a></li>
        <li class="active">Edit Category</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <p class="help-block" style="color:red;"><?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?></p>
                <form role="form" action="<?php echo base_url(); ?>category_master/edit/<?php echo $cid; ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="col-md-6">
                            <!--<?= validation_errors('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>', '</div>'); ?>-->
                            <div class="form-group">
                                <label for="exampleInputFile">Category Name</label><span style="color:red">*</span>
                                <input type="text"  name="name" class="form-control"  value="<?php echo $query->name; ?>" >
                                <span style="color: red;"><?= form_error('name'); ?></span>
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Category icon</label><br>
                                <img src="<?php if($query->cat_icon != ""){ echo $query->cat_icon; }else{ echo base_url()."media/deflaut/missingimage.png"; } ?>" alt="Category icon" style="width:110px; height:90px;"/><br>
                                <input type="file" id="exampleInputFile1" name="categoryicon">
                            </div>
							<div class="form-group">
                                <label for="exampleInputFile">Images</label><br>
                                <img src="<?php echo $query->images; ?>" alt="" style="width:110px; height:90px;"/><br>
                                <input type="file" id="exampleInputFile" name="userfile">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
