<?php

/**
 * return de month name
 *
 * @return sting month day
 */
function month_day($month)
{
    switch ($month) {
      case 1:
        $name = 'Janeiro';
        break;
      case 2:
        $name = 'Fevereiro';
        break;
      case 3:
        $name = 'Março';
        break;
      case 4:
        $name = 'Abril';
        break;
      case 5:
        $name = 'Maio';
        break;
      case 6:
        $name = 'Junho';
        break;
      case 7:
        $name = 'Julho';
        break;
      case 8:
        $name = 'Agosto';
        break;
      case 9:
        $name = 'Setembro';
        break;
      case 10:
        $name = 'Outubro';
        break;
      case 11:
        $name = 'Novembro';
        break;
      case 12:
        $name = 'Dezembro';
        break;
    }

    return $name;
}

/**
 * format amount
 * @param  number $amount

 * @return string  formatted amount string
 */
function fn($amount)
{
    return "R$ ".number_format($amount, 2, ',', '.');
}

/**
 *  calculate profit
 *  @param number $amount
 *
 * @return string  formatted amount string
 */
function calculate_profit($income, $salary, $commission)
{
      $profit = $income - ($salary + $commission);

      return fn($profit);  
}
