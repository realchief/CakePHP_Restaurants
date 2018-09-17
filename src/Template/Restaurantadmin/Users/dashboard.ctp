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
					<span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Sales</span>
						<span class="info-box-number"><?= ($siteSettings['site_currency']);?><?= $salesPrice;?></span>
					</div>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
					<span class="info-box-icon bg-red"><i class="fa fa-car"></i></span>
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
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="toggle-box" style="display: block;  min-height: 50px;  background: #222;
                width: 100%; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); border-radius: 2px; margin-bottom: 15px;">
                    <div class="toggle-text" style="text-align: center;">
                        <span class="toggle-box-text" style="color: white; font-size: 15px;">Turn Online Ordering On/Off</span>
                    </div>
                    <div class="toggle-icon">
                        <input type="checkbox" id="switch" /><label for="switch">Toggle</label>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="toggle-box" style="display: block;  min-height: 50px;  background: #222;
                width: 100%; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); border-radius: 2px; margin-bottom: 15px;">
                    <div class="toggle-text" style="text-align: center;">
                        <span class="toggle-box-text" style="color: white; font-size: 15px;">Turn Delivery On/Off</span>
                    </div>
                    <div class="toggle-icon">
                        <input type="checkbox" id="switch" /><label for="switch">Toggle</label>
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="toggle-box" style="display: block;  min-height: 50px;  background: #222;
                width: 100%; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); border-radius: 2px; margin-bottom: 15px;">
                    <div class="toggle-text-left" style="text-align: center;">
                        <span class="toggle-box-text" style="color: white; font-size: 15px;">Set Your Minimum Pickup Time</span>
                    </div>
                    <div class="toggle-icon">
                    </div>  
                    <div class="toggle-text-right" style="text-align: center;">
                        <span class="toggle-box-text" style="color: white; font-size: 15px;">mins</span>
                    </div> 
                </div>
            </div>
        </div>      		
	</section>
	<section class="content clearfix">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Manage Orders</h3>
					</div>
					<div class="box-body">
						<table id="orderpage" class="orderpage table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Restaurant Name</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Order Date</th>
                            </tr>
                            </thead>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>

    $(document).ready(function(){
        $('#orderpage').DataTable({
            columnDefs: [ { orderable: false, targets: [-2] } ]
        });
        showOrders();
    });

       function showOrders() {
        $("#orderpage").DataTable().destroy();
        $('#orderpage').DataTable( {
            serverSide: true,
            processing: true,
            "ajax": {
                "url": jssitebaseurl+"orders/getOrderDetails",
                "type": "POST",
                'data': {

                }
            },
            "columns": [
                { "data": "Id"  },
                { "data": "Order ID"  },
                { "data": "Customer Name"  },
                { "data": "Restaurant Name"  },
                { "data": "Delivery Date"  },
                { "data": "Status"  },
                { "data": "Order Date"  }

            ]
        });
    }


    function changeOrderStatus(id) {
        var status = $("#currentStatus_"+id+" option:selected").val();
        if(status == 'Failed') {
            $("#orderId").val(id);
            $("#failedReason").modal('show');return false;
        }
        if(status != '' ) {
            $.ajax({
                'type' : 'POST',
                'url' : jssitebaseurl+'orders/changeStatus',
                'data': {id:id,status:status},
                success: function(data) {
                    if($.trim(data) == '1') {
                        showOrders();
                    }
                }
            })
        }
    }



    function deleteRecord(id, urlval, action, page, loadDiv)
    {
        var str = "Are you sure want to delete this "+action;
        if(confirm(str))
        {
            $.ajax({
                type   : 'POST',
                url    : jssitebaseurl+''+urlval,
                data   : {id:id, page:page, action:action},
                success: function(data){

                    $("#ajaxReplace").html(data);
                    $("."+loadDiv).DataTable({
                        columnDefs: [ { orderable: false, targets: [-1,-2,-4] } ]
                    });
                }
            });return false;
        }
    }

    function submitReason(id) {
        var status = 'Failed';
        var failed_reason = $("#failedreason").val();
        var id = $("#orderId").val();

        if(status != '' && failed_reason == '') {
            $(".failedreason").addClass('error').html("Please enter your reason");
            $("#failedreason").focus();
            return false;

        }else{
            $.ajax({
                'type' : 'POST',
                'url' : jssitebaseurl+'orders/changeStatus',
                'data': {id:id,status:status,failed_reason:failed_reason},
                success: function(data) {
                    if($.trim(data) == '1') {
                        $("#failedReason").modal('hide');
                        $("#failedreason").val('');
                        showOrders();
                    }
                }
            })
        }
    }
</script>

<div class="modal fade" id="failedReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Failed Reason</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="orderId">
                    <span class="failedreason"> </span>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="failedreason"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button onclick="submitReason()" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>