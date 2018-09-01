<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Manage Addons
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Manage Addons</li>
		</ol>
	</section>
	<section class="content clearfix">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Manage Addons</h3>
					</div>
					<div class="box-body">
						<table id="addonTable" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>SNo</th>
									<th>Addons Name</th>
									<th>Category</th>
									<th>Status</th>
								</tr>
							</thead>
							<?php if(!empty($addonsList)) {
								foreach ($addonsList as $key => $value) {  ?>
                                    <tr>
                                        <td><?php echo $key+1;?></td>
                                        <td><?php echo $value['mainaddons_name'];?></td>
                                        <td><?php echo $value['category']['category_name'];?></td>
                                        <td>
                                            <?php if($value['status'] == '0') { ?>
                                                <a class="buttonStatus"><i class="fa fa-close"></i></a>
                                            <?php } else { ?>
                                                <a class="buttonStatus"><i class="fa fa-check"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>
								<?php }
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
        $('#addonTable').DataTable({
            columnDefs: [ { orderable: false, targets: [-1] } ]
        });
    });
</script>