<head>
    <title>Lesson 2</title>
    <link
        rel="stylesheet"
        href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/default.min.css"
    >
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('pre').forEach((block) => {
                hljs.highlightBlock(block);
            });
        });
    </script>
    <style>
        pre {
            padding: 20px 30px !important;
            background: #ecfaff !important;
        }
    </style>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: rogozhuk
 * Date: 14.04.19
 * Time: 13:24
 */
mb_internal_encoding("UTF-8");

echo '<div style="
max-width: 900px;
font-size: 18px;
margin: 0 auto;
font-family: Helvetica Neu, sans-serif;
color: #0b232f;
">';
echo '<h1 style="text-align: center">Lesson 2</h1>';
echo '<h2 style="text-align: center">Evgenii Rogozhuk</h2>';
echo '<br/><br/>';
echo '<b>1. Какие типы паттернов проектирования существуют?</b>';
echo '<br/><br/>';
print_r('
Основные шаблоны (Fundamental)<br/><br/>
Порождающие шаблоны проектирования (Creational) — шаблоны проектирования, которые абстрагируют процесс инстанцирования. 
Они позволяют сделать систему независимой от способа создания, композиции и представления объектов. Шаблон, порождающий 
классы, использует наследование, чтобы изменять инстанцируемый класс, а шаблон, порождающий объекты, делегирует 
инстанцирование другому объекту<br/><br/>
Структурные шаблоны проектирования (Structural) — определяют различные сложные структуры, которые изменяют интерфейс уже 
существующих объектов или его реализацию, позволяя облегчить разработку и оптимизировать программу.<br/><br/>
Поведенческие шаблоны проектирования (Behavioral) — определяют взаимодействие между объектами, увеличивая таким образом 
его гибкость.<br/><br/>
');
echo '<br/><br/>';
echo '<b>2. Как можно улучшить Singleton при помощи trait-ов?</b>';
echo '<br/><br/>';
print_r('
Получить внутри вызываемого метода название класса, к которому он был вызван, а затем в качестве хранилища 
воспользоваться отдельным классом со статическим методом, например:
<pre>
trait Singleton {
    
    static public function getInstance()
    {
        $class = get_called_class(); //работает аналогично static::
        
        if (!Storage::hasInstance($class)) {
            $new = new static();
            Storage::setInstance($class, $new);
            
        }
        return Storage::getInstance($class);
    }
}
</pre>

Воспользоваться использованием ключевого слова static при объявлении переменной. 
<pre>
trait Singleton 
{
    static public function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        return $instance;
    }
}

class MyClass 
{
    use Singleton;
}

class MyExtClass extends MyClass {}

echo get_class(MyClass::getInstance()), PHP_EOL; //MyClass
echo get_class(MyExtClass::getInstance()), PHP_EOL; //MyExtClass
</pre>
');
echo '<br/><br/>';
echo '<b>3. Как реализуется паттерн Фабричный метод? В чем его отличие от паттерна Фабрика?</b>';
echo '<br/><br/>';
print_r('
Фабричный метод — порождающий шаблон проектирования, предоставляющий подклассам интерфейс для создания экземпляров 
некоторого класса. В момент создания наследники могут определить, какой класс создавать. Иными словами, данный шаблон 
делегирует создание объектов наследникам родительского класса. Это позволяет использовать в коде программы не 
специфические классы, а манипулировать абстрактными объектами на более высоком уровне.
<br/>
<br/>
В объектно-ориентированном программировании (ООП), фабрика — это объект для создания других объектов. 
Формально фабрика — это функция или метод, который возвращает объекты изменяющегося прототипа или класса из некоторого 
вызова метода, который считается «новым».
');
echo '<br/><br/>';
echo '<b> 4. Объясните назначение и применение магических методов __get, __set, __isset, __unset, __call и __callStatic. 
Когда, как и почему их стоит использовать (или нет)?</b>';
echo '<br/><br/>';
print_r('
Все магические методы ДОЛЖНЫ объявлены как public.<br/>
__get - будет выполнен при чтении данных из недоступных свойств.<br/>
__set - будет выполнен при записи данных в недоступные свойства.<br/>
__isset - будет выполнен при использовании isset() или empty() на недоступных свойствах.<br/>
__unset - будет выполнен при вызове unset() на недоступном свойстве.<br/>
__call - запускается при вызове недоступных методов в контексте объект.<br/>
__callStatic - запускается при вызове недоступных методов в статическом контексте.
<br/>
<br/>
__get(), __set(), __isset(), __unset() - Первые четыре метода в нашем списке используются для перегрузки свойств объекта. 
Они позволяют определить, каким образом будет взаимодействовать внешний мир со свойствами, объявленными с модификатором 
видимости private или protected, либо вообще отсутствующими у объекта.Грозят потерей инкапсуляции. Примененимо при 
лжерефакторинге и попытки избавиться от сеттеров и геттеров.
__call и __callStatic, выполняют похожую функцию, позволяя реализовать перегрузку методов. Они позволяют нам определить,
 как класс и его экземпляры отреагируют на попытки вызова неопределенных, защищенных или приватных методов.
');
echo '<br/><br/>';
echo '<b>5. Опишите несколько структур данных из стандартной библиотеки PHP (SPL). Приведите примеры использования.</b>';
echo '<br/><br/>';

print_r('
SplDoublyLinkedList - обеспечивает основные функциональные возможности двусвязного списка.<br/>
<ul>
<li>SplDoublyLinkedList::add — Добавляет/вставляет новое значение по указанному индексу</li>
<li>SplDoublyLinkedList::bottom — Получает узел, находящийся в начале двусвязного списка</li>
<li>SplDoublyLinkedList::__construct — Создает новый двусвязный список</li>
<li>SplDoublyLinkedList::count — Подсчитывает количество элементов в двусвязном списке</li>
<li>SplDoublyLinkedList::current — Возвращает текущий элемент массива</li>
<li>SplDoublyLinkedList::getIteratorMode — Возвращает режим итерации</li>
<li>SplDoublyLinkedList::isEmpty — Проверяет, является ли двусвязный список пустым</li>
<li>SplDoublyLinkedList::key — Возвращает индекс текущего узла</li>
<li>SplDoublyLinkedList::next — Перемещает итератор к следующему элементу</li>
<li>SplDoublyLinkedList::offsetExists — Проверяет, существует ли запрашиваемый индекс</li>
<li>SplDoublyLinkedList::offsetGet — Возвращает значение по указанному индексу</li>
<li>SplDoublyLinkedList::offsetSet — Устанавливает значение по заданному индексу $index в $newval</li>
<li>SplDoublyLinkedList::offsetUnset — Удаляет значение по указанному индексу $index</li>
<li>SplDoublyLinkedList::pop — Удаляет (выталкивает) узел, находящийся в конце двусвязного списка</li>
<li>SplDoublyLinkedList::prev — Перемещает итератор к предыдущему элементу</li>
<li>SplDoublyLinkedList::push — Помещает элемент в конец двусвязного списка</li>
<li>SplDoublyLinkedList::rewind — Возвращает итератор в начало</li>
<li>SplDoublyLinkedList::serialize — Сериализует хранилище</li>
<li>SplDoublyLinkedList::setIteratorMode — Устанавливает режим итерации</li>
<li>SplDoublyLinkedList::shift — Удаляет узел, находящийся в начале двусвязного списка</li>
<li>SplDoublyLinkedList::top — Получает узел, находящийся в конце двусвязного списка</li>
<li>SplDoublyLinkedList::unserialize — Десериализует хранилище</li>
<li>SplDoublyLinkedList::unshift — Вставляет элемент в начало двусвязного списка</li>
<li>SplDoublyLinkedList::valid — Проверяет, содержит ли узлы двусвязный список</li>
</ul>
SplStack - предоставляет основные функциональные возможности стека, реализованные с использованием двусвязного списка<br/>
<ul>
<li>SplStack::__construct — Создает новый стек, реализованный с использованием двусвязного списка</li>
<li>SplStack::setIteratorMode — Устанавливает режим итератора</li>
</ul>
SplQueue - предоставляет основные функциональные возможности очереди, реализованные с использованием двусвязного списка.<br/>
<ul>
<li>SplQueue::__construct — Создает новую очередь, реализованную с использованием двусвязного списка</li>
<li>SplQueue::dequeue — Удаляет элемент из очереди</li>
<li>SplQueue::enqueue — Добавляет элемент в очередь</li>
<li>SplQueue::setIteratorMode — Устанавливает режим итератора</li>
</ul>
SplHeap - предоставляет основные функциональные возможности кучи.
<ul>
<li>SplHeap::compare — Сравнивает элементы, чтобы во время сортировки корректно разместить их в куче</li>
<li>SplHeap::__construct — Создает новую пустую кучу</li>
<li>SplHeap::count — Определяет количество элементов в куче</li>
<li>SplHeap::current — Возвращает текущий узел, на который указывает итератор</li>
<li>SplHeap::extract — Извлекает узел из кучи и пересортирует ее</li>
<li>SplHeap::insert — Вставляет элемент в кучу и пересортирует ее</li>
<li>SplHeap::isCorrupted — Указывает, находится ли куча в поврежденном состоянии</li>
<li>SplHeap::isEmpty — Проверка, пуста ли куча</li>
<li>SplHeap::key — Возвращает индекс текущего узла</li>
<li>SplHeap::next — Переход к следующему узлу</li>
<li>SplHeap::recoverFromCorruption — Восстанавливает корректное состояние кучи</li>
<li>SplHeap::rewind — Перевод итератора на начало</li>
<li>SplHeap::top — Возвращает узел находящийся на вершине кучи</li>
<li>SplHeap::valid — Проверяет, содержит ли куча еще элементы</li>
</ul>
SplMaxHeap
<ul>
<li>SplMaxHeap::compare — Сравнивает элементы, чтобы во время сортировки корректно разместить их в куче</li>
</ul>
SplMinHeap
<ul>
<li>SplMinHeap::compare — Сравнивает элементы, чтобы во время сортировки корректно разместить их в куче</li>
</ul>
SplPriorityQueue
<ul>
<li>SplPriorityQueue::compare — Сравнивает приоритеты для корректного помещения элементов в очередь</li>
<li>SplPriorityQueue::__construct — Создает новую пустую очередь</li>
<li>SplPriorityQueue::count — Производит подсчет элементов в очереди</li>
<li>SplPriorityQueue::current — Возвращает текущий узел, на который указывает итератор</li>
<li>SplPriorityQueue::extract — Извлекает узел из начала очереди и пересортирует ее</li>
<li>SplPriorityQueue::getExtractFlags — Получить флаги извлечения</li>
<li>SplPriorityQueue::insert — Добавляет элемент в очередь и пересортирует ее</li>
<li>SplPriorityQueue::isCorrupted — Указывает, находится ли приоритетная очередь в поврежденном состоянии</li>
<li>SplPriorityQueue::isEmpty — Проверяет, является ли очередь пустой</li>
<li>SplPriorityQueue::key — Возвращает индекс текущего узла</li>
<li>SplPriorityQueue::next — Переход к следующему узлу</li>
<li>SplPriorityQueue::recoverFromCorruption — Восстанавливает корректное состояние очереди</li>
<li>SplPriorityQueue::rewind — Переводит итератор на начало очереди</li>
<li>SplPriorityQueue::setExtractFlags — Задает режим извлечения узлов</li>
<li>SplPriorityQueue::top — Возвращает узел находящийся в начале очереди</li>
<li>SplPriorityQueue::valid — Проверяет, есть ли в очереди еще элементы</li>
</ul>
SplFixedArray
<ul>
<li>SplFixedArray::__construct — Создает новый массив фиксированной длины</li>
<li>SplFixedArray::count — Возвращает размер массива</li>
<li>SplFixedArray::current — Возвращает текущий элемент массива</li>
<li>SplFixedArray::fromArray — Импортирует PHP-массив в объект класса SplFixedArray</li>
<li>SplFixedArray::getSize — Получает размер массива</li>
<li>SplFixedArray::key — Возвращает индекс текущего элемента массива</li>
<li>SplFixedArray::next — Переходит к следующему элементу массива</li>
<li>SplFixedArray::offsetExists — Возвращает факт наличия указанного индекса массива</li>
<li>SplFixedArray::offsetGet — Возвращает значение по указанному индексу</li>
<li>SplFixedArray::offsetSet — Устанавливает новое значение по заданному индексу</li>
<li>SplFixedArray::offsetUnset — Удаляет значение по индексу $index</li>
<li>SplFixedArray::rewind — Выставляет итератор массива в начало</li>
<li>SplFixedArray::setSize — Изменяет размер массива</li>
<li>SplFixedArray::toArray — Возвращает обычный PHP-массив со значениями фиксированного массива</li>
<li>SplFixedArray::valid — Проверяет массив на наличие элементов</li>
<li>SplFixedArray::__wakeup — Переинициализация массива после десериализации</li>
</ul>
SplObjectStorage
<ul>
<li>SplObjectStorage::addAll — Добавляет все объекты из другого контейнера</li>
<li>SplObjectStorage::attach — Добавляет объект в контейнер</li>
<li>SplObjectStorage::contains — Проверяет, содержит ли контейнер заданный объект</li>
<li>SplObjectStorage::count — Возвращает количество объектов в контейнере</li>
<li>SplObjectStorage::current — Возвращает текущий объект</li>
<li>SplObjectStorage::detach — Удаляет объект object из контейнера</li>
<li>SplObjectStorage::getHash — Вычисляет уникальный идентификатор для объектов контейнера</li>
<li>SplObjectStorage::getInfo — Возвращает данные ассоциированные с текущим объектом</li>
<li>SplObjectStorage::key — Возвращает индекс текущего положения итератора</li>
<li>SplObjectStorage::next — Переход к следующему объекту</li>
<li>SplObjectStorage::offsetExists — Проверяет, существует ли объект в контейнере</li>
<li>SplObjectStorage::offsetGet — Возвращает данные ассоциированные с объектом object</li>
<li>SplObjectStorage::offsetSet — Ассоциирует данные с объектом в контейнере</li>
<li>SplObjectStorage::offsetUnset — Удаляет объект из контейнера</li>
<li>SplObjectStorage::removeAll — Удаляет из текущего контейнера объекты, которые есть в другом контейнере</li>
<li>SplObjectStorage::removeAllExcept — Удаляет из текущего контейнера все объекты, которых нет в другом контейнере</li>
<li>SplObjectStorage::rewind — Переводит итератор на первый элемент контейнера</li>
<li>SplObjectStorage::serialize — Сериализует контейнер</li>
<li>SplObjectStorage::setInfo — Ассоциирует данные с текущим объектом контейнера</li>
<li>SplObjectStorage::unserialize — Восстанавливает сериализованый контейнер из строки</li>
<li>SplObjectStorage::valid — Определяет, допустимо ли текущее значение итератора</li>
</ul>
SPL предоставляет набор стандартных структур данных. Они сгруппированы здесь по своей базовой реализации, которая 
обычно определяет их общую область применения.
');

echo '<br/><br/>';
echo '<b>6. Найдите все ошибки в коде:</b>';
echo '<br/><br/>';
print_r('
<pre>
interface MyInt {
    public function funcI();
    
    // интерфейс может иметь только публичные методы
    private function funcP(); 
} 

class A {
    protected prop1; // Неверное объявление без $
    private prop2; // Неверное объявление без $

    function funcA(){
    
       // Ничего не даст так как не объявлено значяение 
       // переменной $prop2 в случае верного написания
       return $this->prop2; 
    }
}

class B extends A {
    function funcB(){
   
       // Ничего не даст так как не объявлено значяение переменной 
       // $prop1 в случае верного написания
       return $this->prop1; 
    }
}

// Нет метода funcI() объявленного в интерфейсе MyInt
class C extends B implements MyInt {
    function funcB(){
    
       // Ничего не даст так как не объявлено значяение переменной 
       // $prop1 в случае верного написания
       return $this->prop1; 
    }
    private function funcP(){  // Не нужный метод
       return 123;
    }
}  
$b = new B();

// Ничего не даст так как не объявлено значяение переменной 
// $prop1 в случае верного написания
$b->funcA(); 
$c = new C();

// Ошибка, в классе С Нет метода funcI() объявленного в MyInt
$c->funcI(); 
</pre>
');
echo 'Рабочий пример: ';
echo '<br/><br/>';
interface MyInt
{
    public function funcI();
}

class A
{
protected $prop1 = 'Params for $prop1';
private $prop2 = 'Params for $prop2';

    function funcA()
    {
        return $this->prop2;
    }
}

class B extends A
{
    function funcB()
    {
        return $this->prop1;
    }
}

class C extends B implements MyInt
{
    function funcB()
    {
        return $this->prop1;
    }

    public function funcI()
    {
        return 'Returns of missed method funcI()';
    }
}

$b = new B();
echo '$b->funcA(): ' . $b->funcA();
echo '<br/>';
$c = new C();
echo '$c->funcI(): ' . $c->funcI();

echo '<br/><br/>';
echo '<h3 style="text-align: center;border-top: 1px solid #ddd; padding-top: 20px;">Конец задания</h3>';
echo '<br/><br/>';
echo '</div>';
