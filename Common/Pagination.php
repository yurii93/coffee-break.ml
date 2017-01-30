<?php

namespace Common;

/*
 * Класс для генерации постраничной навигации
 */

class Pagination
{
    /**
     * 
     * @var Ссылок навигации на страницу
     * 
     */
    private $max = 10;

    /**
     * 
     * @var Ключ для GET, в который пишется номер страницы
     * 
     */


    /**
     * 
     * @var Текущая страница
     * 
     */
    private $current_page;

    /**
     * 
     * @var Общее количество записей
     * 
     */
    private $total;

    /**
     * 
     * @var Записей на страницу
     * 
     */
    private $limit;

    /**
     * Запуск необходимых данных для навигации
     * @param integer $total - общее количество записей
     * @param integer $limit - количество записей на страницу
     * 
     * @return
     */
    public function __construct($total, $currentPage, $limit)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;


        # Устанавливаем количество страниц
        $this->amount = $this->amount();

        # Устанавливаем номер текущей страницы
        $this->setCurrentPage($currentPage);
    }

    /**
     *  Для вывода ссылок
     * 
     * @return HTML-код со ссылками навигации
     */
    public function get()
    {

        if ($this->total > $this->limit) {

            # Для записи ссылок
            $links = null;

            # Получаем ограничения для цикла
            $limits = $this->limits();

            $html = '<ul class="pagination">';
            # Генерируем ссылки

            /*for ($page = $limits[0]; $page <= $limits[1]; $page++) {
                # Если текущая это текущая страница, ссылки нет и добавляется класс active
                if ($page == $this->current_page) {
                    $links .= '<li class="active"><span>' . $page . '</span></li>';
                } else {
                    # Иначе генерируем ссылку
                    $links .= $this->generateHtml($page, null );
                }
            }*/

            // Мое отображение
            if($this->amount() < 3) {

                if ($this->current_page == 1) {
                    $links = '<li class="active"><span>' . $this->current_page . '</span></li>' .
                        $this->generateHtml($this->current_page + 1, null, $this->current_page + 1);
                }  elseif ($this->current_page == $this->amount()) {
                    $links = $this->generateHtml($this->current_page - 1, null, $this->current_page - 1) .
                        '<li class="active"><span>' . $this->current_page . '</span></li>';
                }

            } else {

                if ($this->current_page == 1) {
                    $links = '<li class="active"><span>' . $this->current_page . '</span></li>' .
                        $this->generateHtml($this->current_page + 1, null, $this->current_page + 1) .
                        $this->generateHtml($this->current_page + 2, null, $this->current_page + 2);
                } elseif ($this->current_page > 1 && $this->current_page < $this->amount()) {
                    $links = $this->generateHtml($this->current_page - 1, null, $this->current_page - 1) .
                        '<li class="active"><span>' . $this->current_page . '</span></li>' .
                        $this->generateHtml($this->current_page + 1, null, $this->current_page + 1);
                } elseif ($this->current_page == $this->amount()) {
                    $links = $this->generateHtml($this->current_page - 2, null, $this->current_page - 2) .
                        $this->generateHtml($this->current_page - 1, null, $this->current_page - 1) .
                        '<li class="active"><span>' . $this->current_page . '</span></li>';

                }

            }

            # Если ссылки создались
            if (!is_null($links)) {
                # Если текущая страница не первая
                if ($this->current_page > 1)
                    # Создаём ссылку "На первую"
                    $links = $this->generateHtml(1, '<i class="fa fa-chevron-left" aria-hidden="true"></i><i class="fa fa-chevron-left" aria-hidden="true"></i>', "На первую") .
                        $this->generateHtml($this->current_page - 1, '<i class="fa fa-chevron-left" aria-hidden="true"></i>', "На предыдущую") . $links;

                # Если текущая страница не последняя
                if ($this->current_page < $this->amount)
                    # Создаём ссылку "На последнюю"
                    $links .= $this->generateHtml($this->current_page + 1, '<i class="fa fa-chevron-right" aria-hidden="true"></i>', "На следующую")
                        . $this->generateHtml($this->amount(), '<i class="fa fa-chevron-right" aria-hidden="true"></i><i class="fa fa-chevron-right" aria-hidden="true"></i>', "На последнюю");
            }

            $html .= $links . '</ul>';

            # Возвращаем html
            return $html;
        }
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param integer $page - номер страницы
     * 
     * @return
     */
    private function generateHtml($page, $text = null, $atribute = null)
    {
        # Если текст ссылки не указан
        if (!$text)
        # Указываем, что текст - цифра страницы
            $text = $page;


        if(preg_match('~/[0-9]+~i', $_SERVER['REQUEST_URI'])) {

            $currentURI = preg_replace('~/[0-9]+~i', '', $_SERVER['REQUEST_URI']) . '/';
        } else {

            $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        }

        # Формируем HTML код ссылки и возвращаем
        return
                '<li><a ' . "title='$atribute'" . ' href="' . $currentURI . $page . '">' . $text . '</a></li>';
    }

    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - ceil($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount)
        # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        else {
            # Конец - общее количество страниц
            $end = $this->amount;

            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        # Возвращаем
        return
                array($start, $end);
    }

    /**
     * Для установки текущей страницы
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Получаем номер страницы
        $this->current_page = $currentPage;

        # Если текущая страница боле нуля
        if ($this->current_page > 0) {
            # Если текунщая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
            # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
        # Устанавливаем страницу на первую
            $this->current_page = 1;
    }

    /**
     * Для получения общего числа страниц
     * 
     * @return число страниц
     */
    private function amount()
    {
        # Делим и возвращаем
        return ceil($this->total / $this->limit);
    }

}
