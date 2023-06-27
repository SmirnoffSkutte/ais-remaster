<?php

namespace App\View\Components\Tables;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Список настроек(свойств) таблицы
     */
    /**
     * Название таблицы
     * @var string
     */
    public string $tableName;
    /**
     * Название базы данных,данные из которой хотим представить в виде таблицы
     * @var string
     */
    public string $dbTableName;
    /**
     * Поля из базы данных,которые мы не хотим отображать в таблице.
     * Пишутся ЧЕРЕЗ ЗАПЯТУЮ БЕЗ ПРОБЕЛОВ (column_1,column_2 ...)
     * @var string
     */
    public string $hiddenColumns;
    /**
     * Названия для колонок таблицы на русском.
     * Пишутся в том же порядке,что и в базе данных.Скрываемые колонки просто пропускаем
     * @var string
     */
    public string $columnsLabels;
    /**
     * Возможные лимиты пагинации (по возрастанию)
     * @var string
     */
    public string $paginationLimits;
    /**
     * Первичные данные для отображения
     * @var \Illuminate\Support\Collection
     */
    private $initialData;
    /**
     * Список колонок для отображения в таблице
     * @var array
     */
    private array $finalColumns;
    /**
     * Массив возможных пагинаций(для использования внутри класса)
     * @var array
     */
    private array $paginationLimitsArray;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tableName, $dbTableName, $hiddenColumns,$columnsLabels,$paginationLimits)
    {
        $this->tableName = $tableName;
        $this->dbTableName = $dbTableName;
        $this->hiddenColumns = $hiddenColumns;
        $this->columnsLabels = $columnsLabels;
        $this->paginationLimits = $paginationLimits;
        /**
         * Получаем список нужных пользователю колонок
         */
        $get_columns=[];
        if($hiddenColumns==""){
            $db_columns = DB::select('SHOW COLUMNS FROM '. $dbTableName);
            $get_columns = array_map(function($db_column) {
                return $db_column->Field;
            }, $db_columns);
        } else {
            $hiddenColumns=explode(",",$hiddenColumns);
            $db_columns = DB::select('SHOW COLUMNS FROM '. $dbTableName);
            $fields_list = array_map(function($db_column) {
                return $db_column->Field;
            }, $db_columns);
            /**
             * список нужных полей на английском
             */
            $i=0;
            foreach ($fields_list as $db_column){
                if(in_array($db_column,$hiddenColumns)){
                    unset($fields_list[$i]);
                    $i++;
                } else {
                    $i++;
                }
            }
            $get_columns=$fields_list;
        }

        /**
         * Список нужных пользователю полей с привязанными лейблами
         */
        $columnsInRussian=explode(",",$this->columnsLabels);

        /**
         * Получаем лимиты пагинации и по ним получаем данные
         */
        $pagination_limits_array=explode(',',$this->paginationLimits);
        //dd($pagination_limits_array);
        $this->paginationLimitsArray=$pagination_limits_array;

        $this->initialData=DB::table("$dbTableName")->select($get_columns)->get();
//        dd($this->initialData);
//        dd($get_columns);
        $this->finalColumns=$columnsInRussian;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.table', [
            'initialData' => $this->initialData,
            'finalColumns'=>$this->finalColumns,
            'paginationLimitsArray'=>$this->paginationLimitsArray,
        ]);
    }

}
