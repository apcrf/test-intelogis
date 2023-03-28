<?php

    /**
	 * Класс легко расширяется в контексте транспортных компаний
	 * за счёт добавления методов класса, каждый из которых выполняет
	 * загрузку данных компании и их преобразования в нужный нам формат
     */

class App
{
    /**
     * Эмуляция загрузки информации о стоимости доставки от компании "Быстрая доставка"
	 * @var sourceKladr string // кладр откуда везем
	 * @var targetKladr string // кладр куда везем
	 * @var weight float // вес отправления в кг
	 * @return array
     */
    public static function fastDelivery($sourceKladr, $targetKladr, $weight)
    {
		// $src = file_get_contents(base_url, ...);
		// Эмуляция
		switch (true) {
			case $sourceKladr == "63019000058000300" && $targetKladr == "77000000000151900" && $weight == 1.523 :
				$json = '{
					"price":456.23,
					"period":5,
					"error":"нет ошибок"
				}';
				break;
			case $sourceKladr == "31008000002000100" && $targetKladr == "89002000003000100" && $weight == 7.258 :
				$json = '{
					"price":852.34,
					"period":7,
					"error":"нет ошибок"
				}';
				break;
			case $sourceKladr == "47012000360000200" && $targetKladr == "27002000030000100" && $weight == 6.321 :
				$json = '{
					"price":654.44,
					"period":2,
					"error":"нет ошибок"
				}';
				break;
		}

		// Преобразование данных из формата службы доставки в нужный формат
		$src = json_decode($json, true);
		$res = [];
		$res["service"] = "Быстрая доставка";
		$res["sourceKladr"] = $sourceKladr;
		$res["targetKladr"] = $targetKladr;
		$res["price"] = $src["price"];
		//
		$dateTime = new DateTime();
		$dateTime->add(new DateInterval("P" . $src["period"] . "D"));
		// Если текущее время > 18:00, то добавляется поправка +1 день, т.к. после 18.00 заявки не принимаются
		if ($dateTime->format('H') >= 18)
		{
			$dateTime->add(new DateInterval("P1D"));
		}
		$res["date"] = $dateTime->format('Y-m-d');
		//
		$res["error"] = $src["error"];

        return $res;
    }

    /**
     * Эмуляция загрузки информации о стоимости доставки от компании "Медленная доставка"
	 * @var sourceKladr string // кладр откуда везем
	 * @var targetKladr string // кладр куда везем
	 * @var weight float // вес отправления в кг
	 * @return array
     */
    public static function slowDelivery($sourceKladr, $targetKladr, $weight)
    {
		// $src = file_get_contents(base_url, ...);
		// Эмуляция
		switch (true) {
			case $sourceKladr == "63019000058000300" && $targetKladr == "77000000000151900" && $weight == 1.523 :
				$json = '{
					"coefficient":4.5,
					"date":"2023-03-29",
					"error":"нет ошибок"
				}';
				break;
			case $sourceKladr == "31008000002000100" && $targetKladr == "89002000003000100" && $weight == 7.258 :
				$json = '{
					"coefficient":6.2,
					"date":"2023-04-05",
					"error":"нет ошибок"
				}';
				break;
			case $sourceKladr == "47012000360000200" && $targetKladr == "27002000030000100" && $weight == 6.321 :
				$json = '{
					"coefficient":12.3,
					"date":"2023-04-09",
					"error":"нет ошибок"
				}';
				break;
		}

		// Преобразование данных из формата службы доставки в нужный формат
		$src = json_decode($json, true);
		$res = [];
		$res["service"] = "Медленная доставка";
		$res["sourceKladr"] = $sourceKladr;
		$res["targetKladr"] = $targetKladr;
		$res["price"] = round(150 * $src["coefficient"], 2);
		$res["date"] = $src["date"];
		$res["error"] = $src["error"];

        return $res;
    }

} // class app
