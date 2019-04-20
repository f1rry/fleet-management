<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fleet management</title>
</head>
<body>
	<h1>车队管理系统</h1>
	<table>
		<tr>
			<th>车队id</th>
			<th>车队名称</th>
			<th>状态</th>
		</tr>
		@foreach($fleet as $f)
		<tr>
		<td>{{$f->id}}</td>
		<td>{{$f->fleet_name}}</td>
		<td>
			@if($f->status===0)
				空闲
			@elseif($f->status===1)
				工作
			@elseif($f->status===2)
				禁用
			@endif
		</td>
		<td><a href="/index.php/car/show/{{$f->id}}">管理</a></td>
		<td><a href="/index.php/fleet/delete/{{$f->id}}">删除</a></td>
		</tr>
		@endforeach
	</table>
	<a href="/index.php/fleet/add_form">添加车队</a>
</body>
</html>