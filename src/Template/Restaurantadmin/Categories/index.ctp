<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Category
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Manage Category</li>
		</ol>
	</section>
	<section class="content clearfix">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Category</h3>
						<!-- <a class="btn green pull-right" href="">Add New <i class="fa fa-plus"></i></a> -->
					</div>
					<div class="box-body">
						<table id="categoryTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>SNo</th>
									<th>Category Name</th>
									<th>Sort Order</th>
									<th>Category Id</th>
									<th>Status</th>
								</tr>
							</thead>
							<?php if(!empty($catList)) { ?>
                       			<?php foreach ($catList as $key => $value) { ?>
								<tr>
									<td><?php echo $key+1;?></td>
									<td><?php echo $value['category_name'];?></td>
									<td><?php echo $value['sortorder'];?></td>
									<td><?php echo $value['id'];?></td>
									<td>
                                        <?php if($value['status'] == '0') { ?>
                                            <a class="buttonStatus"><i class="fa fa-close"></i></a>
                                        <?php } else { ?>
                                            <a class="buttonStatus"><i class="fa fa-check"></i></a>
                                         <?php } ?>
                                    </td>
								</tr>
						<?php 	}
                   			} ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#categoryTable').DataTable({
            columnDefs: [ { orderable: false, targets: [-1] } ]
        });
    });
</script>