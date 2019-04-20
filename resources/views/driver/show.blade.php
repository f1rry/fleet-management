<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fleet management</title>
</head>
<body>
	<h1>车队管理系统</h1>
	<h2>{{$car->license_plate}}管理</h2>
	<table>
		<tr>
			<th>司机id</th>
			<th>姓名</th>
			<th>年龄</th>
			<th>状态</th>
		</tr>
		@foreach($car->driver as $d)
		<tr>
		<td>{{$d->id}}</td>
		<td>{{$d->name}}</td>
		<td>{{$d->old}}</td>
		<td>
			@if($d->status===0)
				空闲
			@elseif($d->status===1)
				工作
			@elseif($d->status===2)
				禁用
			@endif
		</td>
		<td><a href="/index.php/mession/add_form/{{$d->id}}">添加任务</a></td>
		<td><a href="/index.php/driver/delete/{{$d->id}}">删除</a></td>
		</tr>
		@endforeach
	</table>
	<a href="/index.php/driver/add_form">添加司机信息</a>
	<a href="/index.php/car/forbidden/{{$car->id}}">禁用该汽车</a>
	<a href="/index.php/car/show/{{$car->fleet->id}}">返回上一级</a>
</body>
</html>