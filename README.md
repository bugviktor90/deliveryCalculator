# Калькулятор доставки

## Задача

Требуется спроектировать модуль расчета доставки для интернет магазина. Модуль должен предоставлять возможность получить
информацию о доставке двумя способами:

- одной конкретной службой
- всеми доступными службами

### Исходные данные

На момент постановки задачи планируется интеграция с двумя внешними службами доставки.

#### Служба А

API службы доставки принимает на вход следующие параметры:

- адрес отправителя
- адрес получателя
- список элементов (для каждого вес, ШхГхВ)

Возвращает:

- стоимость доставки
- количество дней начиная с сегодняшнего

#### Служба B

API службы доставки принимает на вход следующие параметры:

- адрес отправителя
- адрес получателя
- список элементов (для каждого вес, ШхГхВ, кол-во)

Возвращает:

- коэффициент стоимости. В отличии от Службы А, служба Б имеет Базовую стомость доставки, например 150 руб, и конечная
  цена доставки рассчитывается как произведение базовой стоимости на коэффициент.
- дата доставки

### Результат

Результатом выполнения тестового задания должна быть структура классов и интерфейсов, из которой будет понятно
следующее:

- как использовать модуль из клиентского кода
- за какую задачу отвечает каждый из элементов модуля
- как элементы модуля взаимосвязаны между собой

## Установка
```
composer require bugviktor90/delivery-calculator
```
## Использование готового модуля

### Создание запроса
```php
$request = new Request(
    'г. Москва, ул. 1905 года, 1',              //адрес отправителя
    'г. Новосибирск, ул. Ленина, 1',            //адрес получателя
    [
        new RequestItem(100, 200, 300, 5.5, 5), //позиция 1. Ширина 100мм, Длина 200мм, Высота 300мм, Вес 5.5кг, 5 штук
        new RequestItem(1000, 500, 400, 20)     //позиция 2. Ширина 1000мм, Длина 500мм, Высота 400мм, Вес 20кг, 1 штука
    ]
);
```

### Настройка калькулятора
#### Вариант 1
```php
//создаем калькулятор
$deliveryCalculator = new Calculator();
//добавляем нужные провайдеры по мере необходимости
$deliveryCalculator->addProvider(new AProvider());
//провайдер может принимать нужные настройки
$deliveryCalculator->addProvider(new BProvider(['url' => 'http://someurl.com/api']));
```
#### Вариант 2
```php
//создаем провайдер A
$aProvider = new AProvider([
    'url' => 'http://someurl.com/api', 
    'accessKey' => 'someAccessKey', 
    'clientId' => 'someClientId'
]);

//создаем провайдер B
$bProvider = new BProvider(['url' => 'http://anotherurl/api/delivery']);
//создаем калькулятор и сразу устанавливаем нужные провайдеры
$deliveryCalculator = new Calculator([$aProvider, $bProvider]);

//решили добавить еще один провайдер
$localProvider = new LocalProvider(['volumeRate' => 3000, 'weightRate' => 10]);
$deliveryCalculator->addProvider($localProvider);

//и удалить ненужный
$deliveryCalculator->removeProvider($bProvider);

```

### Получение результата

```php
//получить результат для всех установленных провайдеров
$result = $deliveryCalculator->calculateAll($request);

//получить результат для конкретного провайдера
$result = $deliveryCalculator->calculate($request, $aProvider);
```

### Обработка результата
Результатом работы является объект класса DeliveryCalculator\Result\Result
```php
//пример возвращаемого объекта, при работе с двумя провайдерами
DeliveryCalculator\Result\Result Object
(
    [items:protected] => Array
        (
            [DeliveryCalculator\Providers\AProvider] => DeliveryCalculator\Result\ResultItem Object
                (
                    [cost:protected] => 850
                    [date:protected] => DateTime Object
                        (
                            [date] => 2021-03-05 08:23:56.283472
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                )

            [DeliveryCalculator\Providers\BProvider] => DeliveryCalculator\Result\ResultItem Object
                (
                    [cost:protected] => 1400
                    [date:protected] => DateTime Object
                        (
                            [date] => 2021-03-10 00:00:00.000000
                            [timezone_type] => 3
                            [timezone] => UTC
                        )

                )
        )
)

//получение минимальной стоимости доставки
$result->getMinCost();

//получение минимальной даты доставки
$result->getMinDate();

```

## Основные сущности
- DeliveryCalculator\Calculator - Калькулятор доставки
- DeliveryCalculator\Request\Request - Запроса на расчет доставки
- DeliveryCalculator\Request\Item - Позиция в запросе на расчет доставки
- DeliveryCalculator\Providers\Provider - Провайдер для работы со службой доставки
- DeliveryCalculator\Providers\Converters\Converter - Конвертер, преобразующий данные полученные от провайдера 
- DeliveryCalculator\Result\Result - Результат работы калькулятора доставки
- DeliveryCalculator\Result\ResultItem - Результат работы калькулятора по конкретному провайдера
