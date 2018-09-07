<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Sales</span>
						<span class="info-box-number"><?= ($siteSettings['site_currency']);?><?= $salesPrice;?></span>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"> Delivered</span>
						<span class="info-box-number"><?= $deliveredCount;?></span>
					</div>
				</div>
			</div>

			<div class="clearfix visible-sm-block"></div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">No Orders</span>
						<span class="info-box-number"><?= $no_orders;?></span>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">No Customers</span>
						<span class="info-box-number"><?= $no_customers;?></span>
					</div>
				</div>
			</div>
		</div> 		
	</section>
</div>