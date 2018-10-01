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
					<div class="box-body" style="display: grid;">  
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Size</label>
                            <div class="col-sm-4">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_size" class="minimal" <?= ($restDetails['restaurant_size'] == '12 Medium') ? 'checked' : '' ?> value="12 Medium">
                                    12" Medium
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="restaurant_size" class="minimal" value='14 Large' <?= ($restDetails['restaurant_size'] == '14 Large') ? 'checked' : '' ?>>
                                    14" Large
                                </label>                                            
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Crust Style</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_crust_style" class="minimal" <?= ($restDetails['restaurant_crust_style'] == '12 Medium') ? 'checked' : '' ?> value="12 Medium">
                                    12" Medium
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_crust_style" class="minimal" value="14 Large" <?= ($restDetails['restaurant_crust_style'] == '14 Large') ? 'checked' : '' ?>>
                                    14" Large
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Sauces</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_sauces" class="minimal" <?= ($restDetails['restaurant_sauces'] == 'Pizza Sauce') ? 'checked' : '' ?> value="Pizza Sauce">
                                     Pizza Sauce
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_sauces" class="minimal" <?= ($restDetails['restaurant_sauces'] == 'Alfredo Sauce') ? 'checked' : '' ?> value="Alfredo Sauce">
                                    Alfredo Sauce
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Cheeses</label>
                            <div class="col-md-4 col-sm-6">
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_cheese_status" class="minimal" <?= ($restDetails['restaurant_cheese_status'] == 'Yes') ? 'checked' : '' ?> value="Yes">Yes
                                </label>
                                <label class="radio-inline no-padding-left">
                                    <input type="radio" name="restaurant_cheese_status" class="minimal" value="No" <?= ($restDetails['restaurant_cheese_status'] == 'No') ? 'checked' : '' ?>>
                                    No
                                </label>
                            </div>

                        </div>
                        <div class="form-group clearfix">
                            <label class="col-md-2 col-sm-4 control-label">Meats</label>
                            <div class="col-md-4 col-sm-6">
                                <div class="col-md-4 col-sm-6 no-padding-right">
                                    <?= $this->Form->input('restaurant_meats',[
                                        'type' => 'select',
                                        'multiple' => 'multiple',
                                        'id'   => 'restaurant_meats',
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
                                    <?= $this->Form->input('restaurant_veggies',[
                                        'type' => 'select',
                                        'multiple' => 'multiple',
                                        'id'   => 'restaurant_veggies',
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
                        <a type="submit" class="btn btn-default m-r-15" href="<?php echo REST_BASE_URL ?>restaurants">Cancel</a>
                        <button type="submit" class="btn btn-info" onclick=" return SaveSettings();">Submit</button>
                    </div>
				</div>
				<?= $this->Form->end();?>
			</div>
		</div>
	</section>
</div>
