	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Target Customers</h1>
        </div>
    </div>
	

	    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
			<form action="<?=$BASE_URL?>pages/target_customers.php" method="get">
				<div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control"  placeholder="Search" name="id" <?php
																								if($_GET['id']){
																									echo 'value="' . $_GET['id'] . '"';
																									}?>>
                    <span class="input-group-addon">
                            <span class="glyphicon glyphicon-search"></span>
                    </span>
                </div>
            </div>
			</form>	
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <?php foreach($table_headers as $table_header) { ?>
                                <th><?=$table_header?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($arr as $entry) { ?>
                            <tr class="odd gradeX">
                                <?php foreach($entry as $key => $value) {
									if($key != "customer_id"){									?>
                                <td><?=$value?></td>
									<?php }} ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
