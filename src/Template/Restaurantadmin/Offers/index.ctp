<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Manage Offer
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active"> Manage Offer </li>
		</ol>
	</section>
	<section class="content clearfix">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                       <a class="btn btn-primary pull-right" href="<?php echo REST_BASE_URL;?>offers/add"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                    <div class="box-body" id="ajaxReplace">
                        <table id="offerTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Offer Type</th>
                                    <th>Offer From</th>                                
                                    <th>Offer To</th>                               
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php if(!empty($offerList)) {
                                    foreach($offerList as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $key+1 ;?></td> 
                                            <td>
                                                <?php if($value['first_user'] == 'Y' && $value['normal'] == 'Y'){?>
                                                    First User & Normal
                                                <?php }else if($value['first_user'] == 'Y' && $value['normal'] == 'N'){?>
                                                    First User
                                                <?php }else if($value['first_user'] == 'N' && $value['normal'] == 'Y'){?>
                                                    Normal
                                               <?php }?>
                                            </td>
                                            <td><?php echo $value['offer_from'];?></td>
                                            <td><?php echo $value['offer_to'];?></td>
                                            <td id="status_<?php echo $value['id'];?>">
                                                <?php if($value['status'] == '0') { ?>
                                                    <button  href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '1', 'status', 'offers/ajaxaction', 'offerStatuschange')"><i class="fa fa-close"></i>
                                                   </button>
                                               <?php }else { ?>
                                                   <button  href="javascript:;" onclick="changeStatus('<?= $value['id'] ?>', '0', 'status', 'offers/ajaxaction', 'offerStatuschange')"><i class="fa fa-check"></i>
                                                  </button>
                                               <?php } ?>
                                            </td>                                            
                                            <td>
                                                <a href="<?php echo REST_BASE_URL ?>offers/edit/<?php echo $value['id'] ?>"><i class="fa fa-pencil"></i></a>
                                               <a id="<?php echo $value['id']; ?>" onclick="return deleteRecord(<?php echo $value['id']; ?>, 'offers/deleteOffer', 'Offers', '', 'offerTable')" href="javascript:;"><i class="fa fa-trash-o"></i></a>
                                            </td>                                        
                                        </tr>  
                                <?php } 
                                } ?>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#offerTable').DataTable({
            columnDefs: [ { orderable: false, targets: [-1,-2] } ]
        });
    });

    function changeStatus(id, changestaus, field, urlval, action)
    {
       $.ajax({
            type   : 'POST',
            url    : jssitebaseurl+'offers/ajaxaction',
            data   : {id:id, field:field ,changestaus:changestaus,action:action},
            success: function(data){
                if(action == '') {
                    window.location.reload();
                }else {                    
                    $("#"+field+"_"+id).html(data);
                    return false;
                }
            }
        });
        return false;
    }

    function deleteRecord(id, urlval, action, page, loadDiv)
    {
        var str = "Are you sure want to delete this "+action;
        if(confirm(str))
        {
            $.ajax({
                type   : 'POST',
                url    : jssitebaseurl+'offers/deleteOffer',
                data   : {id:id, page:page, action:action},
                success: function(data){
                    $("#ajaxReplace").html(data);  
                    $("#"+loadDiv).DataTable({
                        columnDefs: [ { orderable: false, targets: [-1,-2] } ]
                    });                  
                }
            });return false;
        }
    }
</script>