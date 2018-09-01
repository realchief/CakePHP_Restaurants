<div class="content-wrapper">
    <section class="content-header">
        <h1> Add Voucher </h1> 
        <ol class="breadcrumb">
            <li>
              <a href="<?php echo REST_BASE_URL ;?>dashboard">
                 <i class="fa fa-dashboard"></i> Home</a>
            </li>           
            <li class="active">
               <a href="<?php echo REST_BASE_URL ;?>vouchers">Manage Voucher</a>
            </li>
        </ol>
    </section>

    <section class="content clearfix">
        <div class="col-xs-12">
            <div class="row">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><!-- Vouchers --></h3>
                    </div>
                        <?php
                            echo $this->Form->create('voucherAdd', [
                                'id' => 'voucherAddForm'
                            ]);

                            echo $this->Form->input('resid',[
                                'type' => 'hidden',
                                'id'   => 'resid',
                                'class' => 'form-control',
                                'placeholder' => 'Please Select Restaurant',
                                'value' => !empty($resList['id']) ? $resList['id'] : '',
                                'label' => false
                            ]);
                        ?> 
                                          
                        <div class="box-body">
                            <div class="form-group">
                                <label for="voucher_code" class="col-sm-2 control-label">Voucher Code</label>
                                <div class="col-sm-4">
                                    <?= $this->Form->input('voucher_code',[
                                            'type' => 'text',
                                            'id'   => 'voucher_code',
                                            'class' => 'form-control',
                                            'placeholder' => 'Please Enter Voucher Code',
                                            'label' => false
                                        ]) ?>
                                      <span class="codeErr"></span>    
                                </div>
                            </div>                            
                        </div>
                        
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type Offer</label>
                                <div class="col-sm-4">                                  
                                   <label class="radio-inline no-padding-left">
                                        <input id="single" type="radio" name="type_offer" class="minimal" value="single" checked="checked">
                                        Single
                                    </label>
                                    <label class="radio-inline">
                                        <input id="multiple" type="radio" name="type_offer" class="minimal" value="multiple">
                                        Multiple
                                    </label> 
                                    <span class="typeErr"></span>                                   
                                </div>
                            </div>
                        </div>  

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Type of Offer</label>
                                <div class="col-sm-4">
                                    <label class="radio-inline margin-r-15">
                                        <input id="price" type="radio" checked="checked" name="offer_mode" class="" value="price">
                                        Price
                                    </label>
                                    <label class="radio-inline margin-r-15">
                                        <input id="percentage" type="radio" name="offer_mode" class="" value="percentage">
                                        Percentage
                                    </label>
                                    <label class="radio-inline margin-r-15">
                                        <input id="free_delivery" type="radio" name="offer_mode" class="" value="free_delivery">
                                        Free Delivery
                                    </label>
                                    <span class="offerModeErr"></span>
                                </div>
                            </div>
                       </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="offer_value" class="col-sm-2 control-label"> Offer Value</label>
                                <div class="col-sm-4">
                                    <?= $this->Form->input('offer_value',[
                                            'type' => 'text',
                                            'id'   => 'offer_value',
                                            'class' => 'form-control',
                                            'placeholder' => 'Please Enter Offer Value',
                                            'label' => false
                                        ]) ?>
                                      <span class="offerValueErr"></span>    
                                </div>
                            </div>                            
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                               <label class="col-sm-2 control-label">Date Range <span class="star">*</span></label>
                               <div class="col-md-6 col-lg-5">
                                  <div class="input-group input-medium">
                                       <?= $this->Form->input('voucher_from',[
                                            'type' => 'text',
                                            'id'   => 'voucher_from',
                                            'class' => 'form-control',
                                            'placeholder' => 'From Date',
                                            'label' => false
                                        ]) ?>                                       
                                     <span class="fromErr"></span>    
                                     <span class="input-group-addon"> to </span>
                                      <?= $this->Form->input('voucher_to',[
                                            'type' => 'text',
                                            'id'   => 'voucher_to',
                                            'class' => 'form-control',
                                            'placeholder' => 'To Date',
                                            'label' => false
                                        ]) ?>                                      
                                     <span class="toErr"></span>          
                                  </div>
                               </div>
                            </div>
                        </div>                        
                        
                        <div class="box-footer">
                            <a class="btn btn-default" href="<?php echo REST_BASE_URL?>vouchers/">Cancel</a>
                            <button type="button" class="btn btn-info pull-right" onclick="voucherAdd();">Submit</button>
                        </div>
                    <?= $this->Form->end();?>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">   

    function voucherAdd(){
       
        var voucher_code = $.trim($("#voucher_code").val()); 
        var type_offer   = $.trim($("input[name='type_offer']:checked").val()); 
        var offer_mode   = $.trim($("input[name='offer_mode']:checked").val()); 
        var offer_value  = $.trim($("#offer_value").val()); 
        var from_date    = $.trim($("#voucher_from").val());       
        var to_date      = $.trim($("#voucher_to").val());    
        var eligible_points  = $.trim($("#eligible_points").val());    
        var editid       = $.trim($("#editid").val());  
        $('.error').html('');

        if(voucher_code == '') {
            $('.codeErr').addClass('error').html('Please enter voucher code');
            $("#voucher_code").focus();
            return false;
        }else if(type_offer == '') {
            $('.typeErr').addClass('error').html('Please select type of use');
            $("#single").focus();
            return false;
        }else if(offer_mode == '') {
            $('.offerModeErr').addClass('error').html('Please select type of offer');
            $("#free_delivery").focus();
            return false;               
        }else if( (offer_mode == 'price' || offer_mode == 'percentage') && offer_value == '') {
            $('.offerValueErr').addClass('error').html('Please enter offer value');
            $("#offer_value").focus();
            return false;               
        }else if(from_date == ''){
            $('.fromErr').addClass('error').html('Please select voucher from');
            $("#voucher_from").focus();
            return false;   
        }else if(to_date == ''){
            $('.toErr').addClass('error').html('Please select voucher to');
            $("#voucher_to").focus();
            return false;   
        }else {
            $("#voucherAddForm").submit();
        }
    }       

</script>