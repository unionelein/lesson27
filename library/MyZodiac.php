<?php
namespace library;

/**
 * Возвращает ваш знак зодиака
 * В конструктор передается дата рождения в формате 'Y-m-d' (string)
 * @example $myzodiac = new MyZodiac('1997-02-25'); echo $myzodiac->zodiac(); // вернет 'Рыба'
 */
class MyZodiac
{
    protected $d;
    protected $m;
    protected $y;
    protected $zodiac;
    protected $m2days = array(31, 28, 31, 30, 31, 30, 31, 31, 30,31, 30, 31); //количество дней по месяцам

    /**
     * @param $birthday string дата рождения. Формат 'Y-m-d'
     */
    function __construct(string $birthday = '')
    {
        if (!preg_match('/^\s*(\d{4})\s*-\s*(\d{1,2})\s*-\s*(\d{1,2})\s*$/', $birthday, $date)) {
            throw new Exception('Неверный формат строки даты:<br>
                Передано: '.($birthday == '' ? 'Пустая строка' : htmlspecialchars($birthday)).'.
                <br>Нужна дата в формате: \'Y-m-d\'');
        }
        $this->y = (int)$date[1];
        $this->m = (int)$date[2];
        $this->d = (int)$date[3];
        $this->checkDate();
    }
    /**
     * @return string знак зодиака
     */
    public function zodiac()
    {
        $d = $this->d;
        $m = $this->m;
        if     ($this->inInterval([21, 3],  [20, 4]))  $this->zodiac = 'Овен';
        elseif ($this->inInterval([21, 4],  [20, 5]))  $this->zodiac = 'Телец';
        elseif ($this->inInterval([21, 5],  [20, 6]))  $this->zodiac = 'Близнецы';
        elseif ($this->inInterval([21, 6],  [22, 7]))  $this->zodiac = 'Рак';
        elseif ($this->inInterval([23 ,7],  [22, 8]))  $this->zodiac = 'Лев';
        elseif ($this->inInterval([23, 8],  [23, 9]))  $this->zodiac = 'Дева';
        elseif ($this->inInterval([24, 9],  [23, 10])) $this->zodiac = 'Весы';
        elseif ($this->inInterval([24, 10], [21, 11])) $this->zodiac = 'Скорпион';
        elseif ($this->inInterval([22, 11], [21, 12])) $this->zodiac = 'Стрелец';
        elseif ($this->inInterval([22, 12], [19, 1]))  $this->zodiac = 'Козерог';
        elseif ($this->inInterval([22, 1],  [18, 2]))  $this->zodiac = 'Водолей';
        elseif ($this->inInterval([19, 2],  [20, 3]))  $this->zodiac = 'Рыбы';
        else $this->badDate();
        return $this->zodiac;
    }
    /**
     * Проверяет валидность даты, и если такой не существует бросает исключение
     */
    protected function checkDate() 
    {
        if ($this->m < 1 || $this->m > 12) $this->badDate();

        if (isLeap($this->y)) $this->m2days[1] = 29;

        if ($this->d < 1 || $this->d > $this->m2days[$this->m - 1]) $this->badDate();
    }

    protected function badDate()
    {
        throw new Exception('Даты '.$this->y.'-'.$this->m.'-'.$this->d.' не существует');
    }

    /**
     * Проверяет, находится ли дата в заданном интервале
     * @param $date1 array - начало интервала [день, месяц]
     * @param $date2 array - конец  интервала [день, месяц]
     * @return bool - результат (true - находится, false - нет)
     */
    protected function inInterval($date1, $date2)
    {
        $d = $this->d;
        $m = $this->m;
        if (
            ($d >= $date1[0] && $m >= $date1[1] && $m < $date2[1]) || 
            ($d <= $date2[0] && $m <= $date2[1] && $m > $date1[1])
            ) return true;
        return false;
    }
}
