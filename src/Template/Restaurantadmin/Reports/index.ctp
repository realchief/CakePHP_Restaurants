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
                        <a id="btnExport_xls" class="btn btn-primary pull-right">Export via .xls</a>
                        <a id="btnExport_csv" class="btn btn-danger pull-right" style="margin-right: 5px;">Export via csv</a>
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

<script>
    $("#btnExport_xls").click(function (e) {
    
        //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel;charset=utf-8';
        
        var table_html = $('#orderpage')[0].outerHTML;
      
        table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');
        
        var css_html = '<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';       
        
        a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' + table_html + '</body></html>');        
     
        a.download = 'exported_table_' + postfix + '.xls';      
     
        a.click();        
        e.preventDefault();
    });
</script>

<script>
    $("#btnExport_csv").click(function (e) {
    
        //getting values of current time for generating the file name
        var dt = new Date();
        var day = dt.getDate();
        var month = dt.getMonth() + 1;
        var year = dt.getFullYear();
        var hour = dt.getHours();
        var mins = dt.getMinutes();
        var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
        //creating a temporary HTML link element (they support setting file names)
        var a = document.createElement('a');
        //getting data from our div that contains the HTML table
        var data_type = 'data:application/vnd.ms-excel;charset=utf-8';
        
        var table_html = $('#orderpage')[0].outerHTML;
      
        table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');
        
        var css_html = '<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';       
        
        a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' + table_html + '</body></html>');        
     
        a.download = 'exported_table_' + postfix + '.csv';      
     
        a.click();        
        e.preventDefault();
    });
</script>