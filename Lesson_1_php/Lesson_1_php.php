<head>
    <title>Lesson 1</title>
</head>
<?php
/**
 * Created by PhpStorm.
 * User: Evgenii Rogozhuk
 * Date: 09.04.19
 * Time: 22:43
 */
mb_internal_encoding("UTF-8");

echo '<div style="
max-width: 900px;
font-size: 18px;
margin: 0 auto;
font-family: Helvetica Neu, sans-serif;
color: #0b232f;
">';
echo '<h1 style="text-align: center">Lesson 1</h1>';
echo '<h2 style="text-align: center">Evgenii Rogozhuk</h2>';
echo '<br/><br/>';
echo '<b>1. В чем заключается суть ключевого слова global? Когда его применение целесообразно?</b>';
echo '<br/><br/>';
print_r('
Глобальные переменные позволяют пересекать границы между функциями, чтобы обращаться к 
значениям переменных. Ключевое слово global указывает, что данная переменная будет той же самой переменной повсюду 
в программе, то есть глобальной переменной. Изменение глобальной переменной внутри функции можно наблюдать за 
ее пределами. Не существует никаких ограничений на количество глобальных переменных, которые могут обрабатываться
функциейИспользование ключевого слова global вне функции не является ошибкой. Оно может быть использовано 
в файле, который включается внутри функции. 
');
echo '<br/><br/>';
echo '<b>2. Какие суперглобальные переменные вы знаете?</b>';
echo '<br/><br/>';
print_r('
<pre>
$GLOBALS
$_SERVER 
$_GET
$_POST 
$_FILES 
$_COOKIE 
$_SESSION 
$_REQUEST 
$_ENV
</pre>
');
echo '<br/><br/>';
echo '<b>3. Когда нужно использовать закрывающий дескриптор "?>"</b>';
echo '<br/><br/>';

print_r('
Если после закрывающего дескриптора не планируется вывода какого-либо текста, то закрывающий дескриптор можно не 
указывать вовсе. В этом случае считается, что программа завершается в конце файла.
');

echo '<br/><br/>';
echo '<b>4. Что выведет программа в каждом случае и почему?</b>';
echo '<br/><br/>';

print_r('
Это функция для выполнения которой необходимо передать параметр $x, без него вывод будет Fatal error. 
<pre>
function changeX($x)
{
    $x += 5; // Выражение тоже самое что $x = $x + 5
    echo $x; // Вывод результата
}

$x = 1; // Обявлена переменная $x
echo $x; // Выведена переменная $x = 1
changeX($x); // Передана в функцию, для расчета нового значения и вывода = 6
echo $x; // Выведена опять объявленная до функции 1

</pre>
');

echo 'Пример вычисления: ';
function changeX($x)
{
    $x += 5;
    echo $x;
}

$x = 1;
echo '<b>';
echo $x;
changeX($x);
echo $x;
echo '</b>';

echo '<br/><br/>';
echo '<b>5. Что выведет программа в каждом случае и почему?</b>';
echo '<br/><br/>';

print_r('
Данная функция своего рода счетчик, который с каждым объявлением прибавляет +1
<pre>
function test()
{
    static $a = 0; // Начальная точка 0
    echo $a; // Объявление первой точки
    $a++; // Добавление еденицы за счет постфиксного инкремента. Возвращает значение $a, затем увеличивает $a на единицу.
}

test(); // 0
test(); // 1
test(); // 2
</pre>
');

echo 'Пример вычисления: ';
function test()
{
    static $a = 0;
    echo $a;
    $a++;
}
echo '<b>';
test();
test();
test();
echo '</b>';

echo '<br/><br/>';
echo '<b>6. Как перевернуть массив? Есть массив array(‘h’, ‘e’, ‘l’, ‘l’, ‘o’), как из него получить array(‘o’, ‘l’, ‘l’, ‘e’, ‘h’)?</b>';
echo '<br/><br/>';

print_r('
Необходимо использовать функцию `array_reverse`, которая принимает массив array и возвращает новый массив, 
содержащий элементы исходного массива в обратном порядке.
');
echo 'Пример решения:';
echo '<br/>';
echo 'Имеем массив: ';
echo '<b>';
echo json_encode(array('h', 'e', 'l', 'l', 'o'));
echo '</b>';
echo '<br/>';
echo 'Применяем функцию массив: `array_reverse` и переворачиваем его: ';
echo '<b>';
echo json_encode(array_reverse(array('h', 'e', 'l', 'l', 'o')));
echo '</b>';

echo '<br/><br/>';
echo '<b>7. Как перевернуть строку задом наперед?</b>';
echo '<br/><br/>';

print_r('
strrev — Переворачивает строку задом наперед, единственный момент в этом свойстве с кириллицей могут быть ошибки. 
');
echo '<br/><br/>';
echo 'Пример решения c `strrev`: ';
echo '<b>';
echo strrev('Hello world!');
echo '</b>';

echo '<br/><br/>';
echo 'Пример решения c `preg_match_all`, `implode` и `array_reverse`: ';

$str = "Переворачивает строку задом наперед";
preg_match_all('/./u', $str, $a);
echo '<b>';
echo implode('', array_reverse($a[0]));
echo '</b>';

echo '<br/><br/>';
echo '<b>8. Что будет результатом работы данного кода?</b>';
echo '<br/><br/>';

print_r('
Результатом будет Two, так как 0 ничто иное как false при if
<pre>
$a = 0; // Объявлена переменная
if ($b = $a) // Передано в $b значение переменной 0
    echo "One"; // Не попадаем так как 0 
else
    echo "Two"; // Попадаем сюда и получаем вывод 

</pre>
');
echo 'Пример решения: ';
$a = 0;
if ($b = $a)
    echo "One";
else
    echo "Two";

echo '<br/><br/>';
echo '<b>9. Сгенерировать три случайных числа в диапазоне от 0 до 10. Если сумма этих чисел меньше 15, сгенерировать новую тройку.</b>';
echo '<br/><br/>';

/**
 * @function
 * @name getSumNumbers Generator generate three random numbers and their sum
 * @description I understand what i can right this i one line, i do like this only for demonstration
 * @return array of numbers and their sum
 */
function getSumNumbers()
{
    $num1 = mt_rand(0, 10);
    $num2 = mt_rand(0, 10);
    $num3 = mt_rand(0, 10);
    $sum = $num1 + $num2 + $num3;
    return [
        'sum' => $sum,
        'numberOne' => $num1,
        'numberTwo' => $num2,
        'numberThree' => $num3,
    ];
}

// Cycle with condition: max cycle < 10 that will stop max iteration or before sum of numbers < 10
$numSum = 0;
$numbers = [];
for($i = 0; $numSum < 15; $i++) {
    $numbers = getSumNumbers();
    $numSum = $numbers['sum'];
}

echo '<pre>';
echo 'Итерации до нахождения суммы > 15: ' . $i;
echo '<br/><br/>';
echo 'Решение: ' . json_encode($numbers);
echo '</pre>';


echo '<br/><br/>';
echo '<b>10. Какое число выведет данный код?</b>';
echo '<br/>';

print_r('
<pre>
<b>
$i = 10;
$i += ++$i + $i + $i++;
echo $i;
</b>
$i = 10;
// сначала выполняется постфиксный инкремент так как приоритет выше, чем у префиксного
$i += ++$i + $i + $i++;
// Получится следующее выражение 
$i += ++$i +$i + 10
// Далее выполняется префиксный инкремент и выражение станет такого вида
$i += 11 +$i + 11
// Значение $i будет равно 11, а так как все операнды - переменная $i, то выражение принимает значение
$i += 11 + 11 + 11
// Затем идет сложение
$i += 33
// Так как это выражение эквивалентен $i = $i + 33 то получаем:
$i = 12 + 33
Итого получаем результат равный 45
echo $i;
</pre>
');

echo 'Пример решения: ';
$i = 10;
$i += ++$i + $i + $i++;
echo $i;

echo '<br/><br/>';
echo '<b>11. Что выведет приведенный ниже код?</b>';
echo '<br/><br/>';

print_r('
<pre>
$a = "1"; // Это тип строка или массив символов, значит получаем, что [0 => \'1\']
$a[$a] = "2"; // По ключу можно получать или менять значение, в данной строке ключу 1 назначили цифру 2.
echo $a; // В итоге решения получаем, что есть массив с [0 => \'1\', 1 => \'2\'] на выходе имеем 12
');
echo '<br/><br/>';
echo 'Пример решения: ';
$a = "1";
$a[$a] = "2";
echo $a;

echo '<br/><br/>';
echo '<h3 style="text-align: center;border-top: 1px solid #ddd; padding-top: 20px;">Еонец задания</h3>';
echo '<br/><br/>';
echo '</div>';