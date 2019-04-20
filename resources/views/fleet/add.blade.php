<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>车队添加</title>
</head>
<body>
	<form action="/index.php/fleet/add" method="post">
	 	{{ csrf_field() }}
		车队名称<input type="text" name="fleet_name"><br>
		<input type="hidden" name="status" value="0">
		<input type="submit">
	</form>
</body>
</html>