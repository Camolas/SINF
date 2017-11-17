	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Target Customers</h1>
        </div>
    </div>
	

	    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <?php foreach($table_headers as $table_header) { ?>
                                <th><?=$table_header?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($entries as $entry) { ?>
                            <tr class="odd gradeX">
                                <?php foreach($entry as $key => $value) { ?>
                                <td><?=$value?></td>
                                <?php } ?>
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
