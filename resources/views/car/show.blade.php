<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fleet management</title>
</head>
<body>
	<h1>车队管理系统</h1>
	<h2>{{$fleet->fleet_name}}管理</h2>
	<table>
		<tr>
			<th>汽车id</th>
			<th>汽车牌照</th>
			<th>状态</th>
		</tr>
		@foreach($fleet->car as $c)
		<tr>
		<td>{{$c->id}}</td>
		<td>{{$c->license_plate}}</td>
		<td>
			@if($c->status===0)
				空闲
			@elseif($c->status===1)
				工作
			@elseif($c->status===2)
				禁用
			@endif
		</td>
		<td><a href="/index.php/driver/show/{{$c->id}}">管理</a></td>
		<td><a href="/index.php/car/delete/{{$c->id}}">删除</a></td>
		</tr>
		@endforeach
	</table>
	<a href="/index.php/car/add_form">添加汽车</a>
	<a href="/index.php/fleet/forbidden/{{$fleet->id}}">禁用车队</a>
	<a href="/index.php/fleet/show">返回上一级</a>
</body>
</html>