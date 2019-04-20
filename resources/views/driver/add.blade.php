<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>司机添加</title>
</head>
<body>
	<form action="/index.php/driver/add" method="post">
	 	{{ csrf_field() }}
		姓名<input type="text" name="name"><br>
		年龄<input type="text" name="old"><br>
		<input type="hidden" name="status" value="0">
		<input type="submit">
	</form>
</body>
</html>