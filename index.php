<?php

	require_once "class_app.php";

	// Службы доставки
	$deliveryServices = ["fastDelivery", "slowDelivery"];

	// Набор отправлений
	$deliverySet = [
		[
			"sourceKladr" => "63019000058000300", // Самарская Область, Похвистневский Район, Поселок, Полевая Улица
			"targetKladr" => "77000000000151900", // Москва, ул Александра Солженицына
			"weight" => 1.523
		],
		[
			"sourceKladr" => "31008000002000100", // Белгородская Область, Губкинский Район, Александровский Хутор, Садовая Улица
			"targetKladr" => "89002000003000100", // Ямало-Ненецкий Автономный округ, Красноселькупский Район, Ратта Село, Бурдукова Улица
			"weight" => 7.258
		],
		[
			"sourceKladr" => "47012000360000200", // Ленинградская Область, Ломоносовский Район, Сев.ч.промзоны Горелово Промышленная зона, Северная часть Горелово Промышленная зона, Квартал 12 Территория
			"targetKladr" => "27002000030000100", // Хабаровский Край, Амурский Район, 147 км Поселок и(при) станция(и), Вокзальная Улица
			"weight" => 6.321
		],
	];

	// Стоимость и сроки доставки
	$deliveryPriceList = [];
	// Перебор Набора отправлений
	foreach ($deliverySet as $k=>$v)
	{
		// Перебор Служб доставки
		switch ($_GET["service"]) {
			// Инфо в контексте списка транспортных компаний
			case "all" : $arr = $deliveryServices; break;
			// Инфо в контексте одной выбранной
			default : $arr = [$_GET["service"]]; break;
		}
		foreach ($arr as $method)
		{
			$priceList = App::{$method}($v["sourceKladr"], $v["targetKladr"], $v["weight"]);
			$deliveryPriceList[] = $priceList;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>test-intelogis</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" type="text/css">
</head>
<body>
	<div class="container">
		<h1>Модуль расчёта стоимости доставки</h1>

		<form class="row my-3" action="/index.php" method="get">
			<div class="col-12 col-md-6">
				<select class="form-select" name="service">
					<option value="all" <?=$_GET["service"]=="all"?"selected":""?>>Все компании</option>
					<option value="fastDelivery" <?=$_GET["service"]=="fastDelivery"?"selected":""?>>fastDelivery</option>
					<option value="slowDelivery" <?=$_GET["service"]=="slowDelivery"?"selected":""?>>slowDelivery</option>
				</select>
			</div>
			<div class="col-6 mt-3 mt-md-0">
				<input type="submit" class="btn btn-primary" value="Submit">
			</div>
		</form>

		<table class="table table-striped">
			<thead>
				<tr>
					<th>Компания</th>
					<th>Откуда</th>
					<th>Куда</th>
					<th>Стоимость</th>
					<th>Дата</th>
					<th>Ошибка</th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach ($deliveryPriceList as $v)
	{
?>
				<tr>
					<td><?=$v["service"]?></th>
					<td><?=$v["sourceKladr"]?></td>
					<td><?=$v["targetKladr"]?></td>
					<td class="text-end pe-5"><?=$v["price"]?></td>
					<td><?=$v["date"]?></td>
					<td><?=$v["error"]?></td>
				</tr>
<?php
	}
?>
			</tbody>
		</table>
	</div>

</body>
</html>
