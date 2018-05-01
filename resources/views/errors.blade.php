<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if($err)
	<p style="color: red">{{ $err }}</p>

	@endif

	@if($result)
	<p style="color: green">{{ $result}}</p>
	@endif

</body>
</html>