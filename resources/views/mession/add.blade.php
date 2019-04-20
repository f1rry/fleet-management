<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>任务安排</title>
</head>
<body>
	<form action="/index.php/mession/add" method="post">
	 	{{ csrf_field() }}
		车队id<input type="text" name="fleet_id" value="{{$driver->car->fleet->id}}"><br>
		汽车id<input type="text" name="car_id"  value="{{$driver->car->id}}"><br>
		驾驶员id<input type="text" name="driver_id"  value="{{$driver->id}}"><br>
		出发地<input type="text" name="departure"><br>
		目的地<input type="text" name="destination"><br>
		预计时间<input type="text" name="estimated_time"><br>
		<input type="hidden" name="status" value="0">
		<input type="submit">
	</form>
</body>
</html>
