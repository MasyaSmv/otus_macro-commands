# Otus Macro Commands 🚀

[![tests](https://github.com/MasyaSmv/otus_macro-commands/actions/workflows/tests.yml/badge.svg)](https://github.com/MasyaSmv/otus_macro-commands/actions/workflows/tests.yml)
[![PHP](https://img.shields.io/badge/php-%5E8.3-8892BF.svg?logo=php&logoColor=white)](https://www.php.net/releases/8.3/en.php)
[![License](https://img.shields.io/github/license/MasyaSmv/otus_macro-commands.svg)](LICENSE)

## Учебный мини-фреймворк для шаблона **Command** с поддержкой:

* **MoveCommand / RotateCommand** — базовые действия (переместить, повернуть).
* **CheckFuelCommand / BurnFuelCommand** — расход топлива с проверкой остатка.
* **MacroCommand** — цепочка команд c атомарным выполнением (останавливается и прокидывает `CommandException` при
  ошибке).
* **ChangeVelocityCommand** — пересчёт вектора мгновенной скорости после поворота.

Пример макрокоманд в игре «Космическая битва»:

```php
$move = new MacroCommand(
    new CheckFuelCommand(5),   // 1) есть ли топливо?
    new MoveCommand(1),        // 2) сдвигаемся
    new BurnFuelCommand(5)     // 3) вычитаем расход
);

$rotate = new MacroCommand(
    new RotateCommand($rotator, 30.0),     // меняет угол
    new ChangeVelocityCommand(30.0)        // и вектор скорости
);
```

## 📦 Установка

```bash
Копировать
Редактировать
git clone https://github.com/MasyaSmv/otus_macro-commands.git
cd otus_macro-commands
composer install
```

## 🚀 Быстрый старт

```php
use Masyasmv\OtusMacroCommands\Command\{MoveCommand, CheckFuelCommand, BurnFuelCommand, MacroCommand};
use Masyasmv\OtusMacroCommands\Model\Ship;

$ship = new Ship();           // реализует Positionable, VelocityAware, Rotatable, FuelTankAware
$ship->refillFuel(100);

$moveForward = new MacroCommand(
    new CheckFuelCommand(10),
    new MoveCommand(1),
    new BurnFuelCommand(10)
);

$moveForward->execute($ship);

```

## 🗂️ Структура

```cpp
src/
├── Command/         // все команды (+ исключения)
├── Contract/        // маленькие интерфейсы (Positionable, Rotatable ...)
├── Service/         // Mover, Rotator, FuelTank и т. д.
└── ValueObject/     // Vector2D, etc.
tests/               // PHPUnit-тесты
```

### 🧪 Тесты

```bash
# юнит‐тесты
composer test

# отчёт покрытия (HTML в папке coverage/)
composer test-coverage
```

## 🔧 CI
В проекте лежит настроенный workflow .github/workflows/ci.yml —
он устанавливает PHP 8.3, тянет зависимости и запускает «composer test».

## 📜 Лицензия
Код распространяется под лицензией MIT — см. LICENSE.

