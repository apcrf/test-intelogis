<?php

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
		$res["price"] = $src["price"];
		$res["date"] = new DateTime();
var_dump($res["date"]);
		$res["date"]->add(new DateInterval("P" . $src["period"] . "D"));
		// Если текущее время > 18:00, то добавляется поправка +1 день, т.к. после 18.00 заявки не принимаются
		$res["date"]->add(new DateInterval("P1D"));
		$res["error"] = $src["error"];

        return $res;
    }

} // class app
