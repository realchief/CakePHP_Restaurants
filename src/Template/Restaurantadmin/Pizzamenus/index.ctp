<div class="content-wrapper">
	<section class="content-header">
		<h1>Manage Pizza Menu</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>		
            <li class="active">Manage Pizza Menu</li>
		</ol>
	</section>

	<section class="content clearfix">
		<div class="row">
			<div class="col-xs-12">
				<?php
                    echo $this->Form->create('pizzaSetting', [
                        'id' => 'pizzaSetting',
                        'class' => 'form-horizontal',                           
                        'enctype'  =>'multipart/form-data'
                    ]);
                    echo  $this->Form->input('resId', [
                        'id' => 'resId',
                        'class' => 'form-horizontal',
                        'type' => 'hidden',
                        'value' => !empty($id) ? $id : '',
                        'enctype'  =>'multipart/form-data'
                    ]);
                    echo $this->Form->input('bySearch', [
                        'id' => 'bySearch',
                        'type' => 'hidden',
                        'class' => 'form-horizontal',
                        'value'=> SEARCHBY
                    ]);
                ?>
                <div class="box">
					<div class="box-header">
						<h3 class="box-title">Settings for Manage Pizza Menus</h3>						
					</div>
					<input type="hidden" value="<?= $id ?>" name="editedId" id="resId">
                    <input type="hidden" value="<?= $resId ?>" name="restaurant_id" id="RestId">
					<div class="box-body" style="display: grid;">  
						<div class="form-group">
                            <label class="col-sm-2 control-label">Menu Name<span class="help">*</span></label>
                            <div class="col-sm-4">
                                <?= $this->Form->input('menu_name',[
                                    'type' => 'select',
                                    'id'   => 'menu_name',
                                    'class' => 'form-control',
                                    'options' => $menuList,
                                    'value' => $menuDetails['menu_name'],
                                    'label' => false
                                ]) ?>
                            </div>
                            <span class="menuErr"></span>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-2 control-label">Size</label>
                            <div class="col-sm-4">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_size" class="minimal" <?= ($menuDetails['menu_size'] == '12 Medium') ? 'checked' : '' ?> value="12 Medium">
                                    12" Medium
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="menu_size" class="minimal" value='14 Large' <?= ($menuDetails['menu_size'] == '14 Large') ? 'checked' : '' ?>>
                                    14" Large
                                </label>                                            
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Crust Style</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_crust_style" class="minimal" <?= ($menuDetails['menu_crust_style'] == '12 Medium') ? 'checked' : '' ?> value="12 Medium">
                                    12" Medium
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_crust_style" class="minimal" value="14 Large" <?= ($menuDetails['menu_crust_style'] == '14 Large') ? 'checked' : '' ?>>
                                    14" Large
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Popular</label>
                            <div class="col-sm-4">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="popular_dish" class="minimal" value="Yes" <?= ($menuDetails['popular_dish'] == 'Yes') ? 'checked' : '' ?> >
                                    Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="popular_dish" class="minimal" value="No" <?= ($menuDetails['popular_dish'] == 'No') ? 'checked' : '' ?> >
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Spicy</label>
                            <div class="col-sm-4">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="spicy_dish" class="minimal" value="Yes" <?= ($menuDetails['spicy_dish'] == 'Yes') ? 'checked' : '' ?> >
                                    Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="spicy_dish" class="minimal" value="No" <?= ($menuDetails['spicy_dish'] == 'No') ? 'checked' : '' ?>>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Sauces</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_sauces" class="minimal" <?= ($menuDetails['menu_sauces'] == 'Pizza Sauce') ? 'checked' : '' ?> value="Pizza Sauce">
                                     Pizza Sauce
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_sauces" class="minimal" <?= ($menuDetails['menu_sauces'] == 'Alfredo Sauce') ? 'checked' : '' ?> value="Alfredo Sauce">
                                    Alfredo Sauce
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Cheeses</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_cheese_status" class="minimal" <?= ($menuDetails['menu_cheeses_status'] == 'Yes') ? 'checked' : '' ?> value="Yes">Yes
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="menu_cheese_status" class="minimal" value="No" <?= ($menuDetails['menu_cheeses_status'] == 'No') ? 'checked' : '' ?>>
                                    No
                                </label>
                            </div>

                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Meats</label>
                            <div class="col-md-4 col-sm-6">
                                <div class="col-md-4 col-sm-6 no-padding-right">
                                    <?= $this->Form->input('menu_meats',[
                                        'type' => 'select',
                                        'multiple' => 'multiple',
                                        'id'   => 'menu_meats',
                                        'class' => 'form-control',
                                        'options' => $meatList,
                                        'value' => $selectedMeats,
                                        'label' => false
                                    ]) ?>
                                </div>
                                <span class="meatsErr"></span>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Veggies</label>
                            <div class="col-md-4 col-sm-6">
                                <div class="col-md-4 col-sm-6 no-padding-right">
                                    <?= $this->Form->input('menu_veggies',[
                                        'type' => 'select',
                                        'multiple' => 'multiple',
                                        'id'   => 'menu_veggies',
                                        'class' => 'form-control',
                                        'options' => $veggiesList,
                                        'value' => $selectedVeggies,
                                        'label' => false
                                    ]) ?>
                                </div>
                                <span class="veggiesErr"></span>
                            </div>
                        </div>
                    </div>

					<div class="box-footer">
                        <a type="submit" class="btn btn-default m-r-15" href="<?php echo REST_BASE_URL ?>pizzamenus">Cancel</a>
                        <button type="submit" class="btn btn-info" onclick=" return SaveSettings();">Submit</button>
                    </div>
				</div>
				<?= $this->Form->end();?>
			</div>
		</div>
	</section>
</div>

<script>
	function SaveSettings() {
		$(".error").html('');
        var error = 0;
        var Url   = jssitebaseurl+'pizzamenus/pizzamenusSettings';             
        var resId  = $("#resId").val();
        var selectedId = $("#menu_name").val(); 
        var restaurant_id = $("#RestId").val();  
        var menu_meats = $("#menu_meats").val();  
        var menu_veggies = $("#menu_veggies").val();           
        var menu_size = $.trim($("input[name='menu_size']:checked").val());
        var menu_crust_style = $.trim($("input[name='menu_crust_style']:checked").val());
        var popular_dish = $.trim($("input[name='popular_dish']:checked").val());
        var spicy_dish = $.trim($("input[name='spicy_dish']:checked").val());
        var menu_sauces = $.trim($("input[name='menu_sauces']:checked").val());
        var menu_cheese_status = $.trim($("input[name='menu_cheese_status']:checked").val());

        if(selectedId == '') {
            $(".menuErr").addClass('error').html('Please enter menu name');
            $("#menu_name").focus();
            return false;
        }else {
            var menuLength = 0;
            error = 0;
        }

        if(error == 0 && menuLength == 0){
            $.post(
                Url,
                {
                	'resId': resId,
                	'selectedId': selectedId,                    
                    'restaurant_id' : restaurant_id,
                    'menu_meats':  menu_meats,
                    'menu_veggies' : menu_veggies,
                    'menu_size' :  menu_size,
                    'menu_crust_style' :  menu_crust_style,
                    'popular_dish' :  popular_dish,
                    'spicy_dish'  :  spicy_dish,
                    'menu_sauces'  :  menu_sauces,
                    'menu_cheese_status'  :  menu_cheese_status
                },
                function (data) {                
                    console.log(data);
                }
            );
            return false;
        }
    }
</script>
