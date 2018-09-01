<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Report 
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Report</li>
		</ol>
	</section>
	<section class="content clearfix">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Report </h3>
					</div>
                    <div class="box-body">
                        <table id="orderpage" class="table table-bordered table-hover">
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
                "url": jssitebaseurl+"reports/getOrderDetails",
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
</script>


  <div class="modal fade" id="trackpopup" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Track Order</h4>
        </div>
         <div class="modal-body">
        </div>
      </div>
    </div>
  </div>