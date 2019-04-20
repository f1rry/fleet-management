<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>汽车添加</title>
</head>
<body>
	<form action="/index.php/car/add" method="post">
	 	{{ csrf_field() }}
		汽车牌照<input type="text" name="license_plate"><br>
		<input type="hidden" name="status" value="0">
		<input type="submit">
	</form>
</body>
</html>