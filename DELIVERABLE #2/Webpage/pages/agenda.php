<?php
$table_headers = ["Rendering engine","Browser","Platform(s)","Engine version","CSS grade"];
$entry = [
		"Rendering engine"=> "Trident",
		"Browser"=>"Internet Explorer 4.0",
		"Platform(s)"=>"Win 95+",
		"Engine version"=>"4",
		"CSS grade"=>"X"
	];
$entries = [];
for ($i=0; $i < 1000; $i++)
	array_push($entries, $entry);

	include('../templates/header.php');
	include('../templates/table.php');
	include('../templates/footer.php');
?>

<div id="wrapper">
    <!-- Navigation -->


    <!-- database -->


    <!-- CONTEÚDO -->

    <div id="page-wrapper">

<!-- /.row -->
<div class="row">
    <div class="col-lg-8">
<!-- /.panel-heading -->

<div class="panel-body">
    <div class="list-group">

        <iframe src="https://calendar.google.com/calendar/embed?src=dmcpp8gtvgiksb753qfi4u9qfc%40group.calendar.google.com&ctz=Europe/Lisbon" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
        <a href="#" class="list-group-item">

            <i class="fa fa-comment fa-fw"></i> Novo Comentário
            <span class="pull-right text-muted small"><em>4 minutos atrás</em>
                                    </span>
        </a>

        <a href="account.php?msg=1" class="list-group-item">
            <i class="fa fa-envelope fa-fw"></i> Mensagem enviada
            <span class="pull-right text-muted small"><em>10 minutos atrás</em>
                                    </span>
        </a>
        <a href="#" class="list-group-item">
            <i class="fa fa-tasks fa-fw"></i> Nova Tarefa
            <span class="pull-right text-muted small"><em>09:49</em>
                                    </span>
        </a>

    </div>
