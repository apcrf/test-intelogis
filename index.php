<?php

	require_once "class_app.php";

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
	foreach ($deliverySet as $k=>$v)
	{
		$priceList = App::fastDelivery($v["sourceKladr"], $v["targetKladr"], $v["weight"]);
		$deliveryPriceList[] = $priceList;
	}
	var_dump($deliveryPriceList);
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>test-intelogis</title>
</head>
<body>

	<h1>Модуль расчёта стоимости доставки</h1>

</body>
</html>
