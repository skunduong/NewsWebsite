<!DOCTYPE html>
<html>
<head>
	<title>hello</title>
	<meta charset="utf-8">
</head>
<body>
<h1>PHP24 - Hello world</h1>
<h1><?php echo $hovaten; ?> - <?php echo $monhoc; ?></h1>
<h1>{{ "3 > 5" }}</h1>
<h1>{!! "3 > 5" !!}</h1>
<?php 
	$a = 5;
 ?>
 @if($a % 2 ==0)
 <h1>{{ "$a là số chẵn" }}</h1>
 @else
 <h1>{{ "$a là số lẻ" }}</h1>
 @endif
 <table cellpadding="5" border="1" style="width: 200px; border-collapse: collapse;">
 @for($i = 1; $i <= 5; $i ++)
 	<tr>
 		<td>{{ $i }}</td>
 	</tr>
 @endfor
 </table>
 <?php 
 	$arr = array(5,6,7,8);
  ?>
  @foreach($arr as $value)
  {{ $value."," }}
  @endforeach
</body>
</html>