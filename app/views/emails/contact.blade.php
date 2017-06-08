<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table border="0" style="width:100%;">
		<tr>
			<td colspan="2">Mensaje de la pagina web</td>
			<td></td>
		</tr>
		<tr>
			<td>
				De: {{ $name }}
			</td>
		</tr>
		<tr>
			<td>
				Asunto: {{ $subject }}
			</td>
		</tr>
		<tr>
			<td colspan="2">
				{{ $msg }}
			</td>
		</tr>
		@if(isset($link) && isset($pub_name))
			<tr>
				<td>
					<a href="{{ $link }}">{{ $pub_name }}</a>
				</td>
			</tr>
		@endif
	</table>
</body>
</html>