<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">New Event</h1>
        </div>
</div>
<label>Title</label>
<p><?= $_GET['title'] ?></p>
<label>Type</label>
<p><?= $_GET['type'] ?></p>
<label>Strating Date</label>
<p><?= $_GET['strating_date'] ?></p>
<label>Ending Date</label>
<p><?= $_GET['ending_date'] ?></p>
<label>Client</label>
<p><?= $_GET['client'] ?></p>
<label>Location</label>
<p><?= $_GET['location'] ?></p>
<label>Notes</label>
<p><?= $_GET['notes'] ?></p>

<a href="<?=$BASE_URL?>pages/update_event.php?id=<?=$_GET['id']?>&title=<?=$_GET['title']?>&type=<?=$_GET['type']?>&strating_date=<?=$_GET['strating_date']?>&ending_date=<?=$_GET['ending_date']?>&client=<?=$_GET['client']?>&location=<?=$_GET['location']?>&notes=<?=$_GET['notes']?>"><button type="button" class="btn btn-primary">Update</button></a>
<a href="<?=$BASE_URL?>actions/event/delete_event.php?id=<?=$_GET['id']?>"><button type="button" class="btn btn-danger">Delete</button></a>
</body>
</html>