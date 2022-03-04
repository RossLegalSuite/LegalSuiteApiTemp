<?php

namespace App\Custom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParameterBuilder
{
    public static function ParameterBuilder(&$query, $request)
    {

        /*******************************************************

        Refactored:

        1) Passing $query by address so no need to return it.

        2) Wrap in a try catch so it throws the error back

        try {
            ....
        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }

        3) Refactor the array checking like this example

                foreach ((array) $request->whereraw as $whereRaw) {
                    echo "\nwhereRaw = $whereRaw";
                    $query->whereRaw($whereRaw);
                }
        4) Type $request as Request ??? method = reserved word??

        *******************************************************/

        try {
            if (isset($request->addselectraw)) {
                foreach ((array) $request->addselectraw as $parameter) {
                    $query->addselect(DB::raw(trim($parameter)));
                }
            }

            if (isset($request->selectraw)) {
                foreach ((array) $request->selectraw as $parameter) {
                    $query->addselect(DB::raw(trim($parameter)));
                }
            }

            if (isset($request->addselect)) {
                foreach ((array) $request->addselect as $parameter) {
                    $query->addselect(trim($parameter));
                }
            }

            if (isset($request->select)) {
                foreach ((array) $request->select as $parameter) {
                    $query->addselect(trim($parameter));
                }
            }

            if (isset($request->addcolumnraw)) {
                foreach ((array) $request->addcolumnraw as $parameter) {
                    $query->addselect(DB::raw(trim($parameter)));
                }
            }

            if (isset($request->columnraw)) {
                foreach ((array) $request->columnraw as $parameter) {
                    $query->addselect(DB::raw(trim($parameter)));
                }
            }

            if (isset($request->addcolumn)) {
                foreach ((array) $request->addcolumn as $parameter) {
                    $query->addselect(trim($parameter));
                }
            }

            if (isset($request->column)) {
                foreach ((array) $request->column as $parameter) {
                    $query->addselect(trim($parameter));
                }
            }

            if (isset($request->groupby)) {
                foreach ((array) $request->groupby as $parameter) {
                    $query->groupBy(trim($parameter));
                }
            }

            // if (isset($request->where)) {

            //     foreach ( (array) $request->where as $parameter) {
            //         $query->where(explode(',', trim($parameter)));
            //     }

            // }

            if (isset($request->where)) {
                foreach ((array) $request->where as $parameter) {
                    $whereArray[] = explode(',', trim($parameter));
                }

                $query->where($whereArray);
            }

            if (isset($request->orwhere)) {
                foreach ((array) $request->orwhere as $parameter) {
                    $orWhereArray[] = explode(',', trim($parameter));
                }

                $query->orWhere($orWhereArray);
            }

            if (isset($request->leftjoin)) {
                foreach ((array) $request->leftjoin as $parameter) {
                    $joinArray = explode(',', $parameter);

                    $query->leftJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));
                }
            }

            if (isset($request->whereBetween)) {
                foreach ((array) $request->whereBetween as $parameter) {
                    $whereBetweenArray = explode(',', $parameter);
                    $whereBetweenColumn = trim(array_values($whereBetweenArray)[0]);
                    array_splice($whereBetweenArray, 0, 1);

                    $query->whereBetween($whereBetweenColumn, $whereBetweenArray);
                }
            }

            if (isset($request->wherein)) {
                foreach ((array) $request->wherein as $parameter) {
                    $whereInArray = explode(',', $parameter);
                    $whereInColumn = trim(array_values($whereInArray)[0]);
                    array_splice($whereInArray, 0, 1);

                    $query->whereIn($whereInColumn, $whereInArray);
                }
            }

            if (isset($request->wherenull)) {
                foreach ((array) $request->wherenull as $parameter) {
                    $query->whereNull(trim($parameter));
                }
            }

            if (isset($request->wherenotin)) {
                foreach ((array) $request->wherenotin as $parameter) {
                    $whereNotInArray = explode(',', $parameter);
                    $whereNotInColumn = array_values($whereNotInArray)[0];
                    array_splice($whereNotInArray, 0, 1);

                    $query->whereNotIn($whereNotInColumn, $whereNotInArray);
                }
            }

            if (isset($request->whereraw)) {
                foreach ((array) $request->whereraw as $parameter) {
                    $query->whereRaw(trim($parameter));
                }
            }

            if (isset($request->join)) {
                foreach ((array) $request->join as $parameter) {
                    $joinArray = explode(',', $parameter);

                    $query->join(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));
                }
            }

            if (isset($request->rightjoin)) {
                foreach ((array) $request->rightjoin as $parameter) {
                    $joinArray = explode(',', $parameter);

                    $query->rightJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));
                }
            }

            // if paging is requested, ordering to be done by ControllerHelper/DataFormatHelper
            if (isset($request->orderby) & ! $request->has(['start', 'length'])) {
                foreach ((array) $request->orderby as $parameter) {
                    $orderByArray = explode(',', $parameter);
                    if (isset(array_values($orderByArray)[1])) {
                        $query->orderBy(trim(array_values($orderByArray)[0]), trim(array_values($orderByArray)[1]));
                    } else {
                        $query->orderBy(trim(array_values($orderByArray)[0]), 'ASC');
                    }
                }
            }

            if (isset($request->orderbyraw)) {
                foreach ((array) $request->orderbyraw as $parameter) {
                    $orderByArray = explode(',', $parameter);

                    $query->OrderBy(DB::raw(trim(array_values($orderByArray)[0])), trim(array_values($orderByArray)[1]));
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    // public static function ParameterBuilder(&$query, $request)
    // {

    //     /*******************************************************

    //     Refactor:

    //     1) Passing $query by address so no need to return it.

    //     2) Wrap in a try catch so it throws the error back

    //     try {
    //         ....
    //     } catch(\Exception $e)  {
    //         throw new \Exception($e->getMessage());
    //     }

    //     3) Refactor the array checking like this example

    //             foreach ((array) $request->whereraw as $whereRaw) {
    //                 echo "\nwhereRaw = $whereRaw";
    //                 $query->whereRaw($whereRaw);
    //             }

    //     *******************************************************/

    //     //  return ControllerHelper::tryCatch($request, function ($request) use (&$query) {

    //         $addSelectRaws = $request->input('addselectraw');
    //         if (is_array($addSelectRaws)) {

    //             foreach ($addSelectRaws as $addSelectRaw) {
    //                 $query->addselect(DB::raw(trim($addSelectRaw)));
    //             }
    //         }else if($addSelectRaws) {
    //             $query->addselect(DB::raw(trim($addSelectRaws)));

    //         }

    //         $selectRaws = $request->input('selectraw');
    //         if (is_array($selectRaws)) {

    //             foreach ($selectRaws as $selectRaw) {
    //                 $query->addselect(DB::raw(trim($selectRaw)));
    //             }
    //         }else if($selectRaws) {

    //             $query->addselect(DB::raw(trim($selectRaws)));
    //         }

    //         $addselect = $request->input('addselect');
    //         if (is_array($addselect)) {

    //             foreach ($addselect as $select) {
    //                 $query->addselect(trim($select));
    //             }
    //         }else if($addselect) {
    //             $query->addselect(trim($addselect));

    //         }

    //         $selects = $request->input('select');
    //         if (is_array($selects)) {

    //             foreach ($selects as $select) {
    //                 $query->addselect(trim($select));
    //             }
    //         }else if($selects) {
    //             $query->addselect(trim($selects));

    //         }

    //         $columnRaws = $request->input('addcolumnraw');
    //         if (is_array($columnRaws)) {

    //             foreach ($columnRaws as $columnRaw) {
    //                 $query->addselect(DB::raw(trim($columnRaw)));
    //             }
    //         }else if($columnRaws) {
    //             $query->addselect(DB::raw(trim($columnRaws)));

    //         }

    //         $columnRaws = $request->input('columnraw');
    //         if (is_array($columnRaws)) {

    //             foreach ($columnRaws as $columnRaw) {
    //                 $query->addselect(DB::raw(trim($columnRaw)));
    //             }
    //         }else if($columnRaws) {
    //             $query->addselect(DB::raw(trim($columnRaws)));

    //         }

    //         $addcolumn = $request->input('addcolumn');
    //         if (is_array($addcolumn)) {

    //             foreach ($addcolumn as $column) {
    //                 $query->addselect(trim($column));
    //             }
    //         }else if($addcolumn) {
    //             $query->addselect(trim($addcolumn));

    //         }

    //         $columns = $request->input('column');
    //         if (is_array($columns)) {

    //             foreach ($columns as $column) {
    //                 $query->addselect(trim($column));
    //             }
    //         }else if($columns) {
    //                 $query->addselect(trim($columns));

    //         }

    //         $groupBys = $request->input('groupby');
    //         if (is_array($groupBys)) {

    //             foreach ($groupBys as $groupBy) {
    //                 $query->groupBy(trim($groupBy));
    //             }
    //         }else if($groupBys) {
    //             $query->groupBy(trim($groupBys));

    //         }

    //         $wheres = $request->input('where');

    //         if (is_array($wheres)) {

    //             foreach ($wheres as $where) {
    //                 $whereArray[] = explode(',', trim($where));

    //             }

    //             $query->where($whereArray);

    //         }else if($wheres) {
    //             $whereArray[] = explode(',', trim($wheres));
    //             $query->where($whereArray);

    //         }

    //         $orWheres = $request->input('orwhere');

    //         if (is_array($orWheres)) {
    //             foreach ($orWheres as $orWhere) {

    //                 $orWhereArray[] = explode(',', trim($orWhere));

    //             }

    //             $query->orWhere($orWhereArray);

    //         }else if($orWheres) {
    //             $orWhereArray[] = explode(',', trim($orWheres));
    //             $query->orWhere($orWhereArray);

    //         }

    //         $leftJoins = $request->input('leftjoin');

    //         if (is_array($leftJoins)) {
    //             foreach ($leftJoins as $leftJoin) {
    //                 $joinArray = explode(',', $leftJoin);

    //                 $query->leftJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //             }

    //         }else if($leftJoins) {

    //             $joinArray = explode(',', $leftJoins);

    //             $query->leftJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //         }

    //         $whereIns = $request->input('wherein');

    //         if (is_array($whereIns)) {
    //             foreach ($whereIns as $whereIn) {

    //                 $whereInArray = explode(',', $whereIn);
    //                 $whereInColumn = trim(array_values($whereInArray)[0]);
    //                 array_splice($whereInArray, 0, 1);

    //                 $query->whereIn($whereInColumn, $whereInArray);
    //             }

    //         }else if($whereIns) {

    //             $whereInArray = explode(',', $whereIns);
    //             $whereInColumn = trim(array_values($whereInArray)[0]);
    //             array_splice($whereInArray, 0, 1);

    //             $query->whereIn($whereInColumn, $whereInArray);

    //         }

    //         $whereNulls = $request->input('wherenull');

    //         if (is_array($whereNulls)) {
    //             foreach ($whereNulls as $whereNull) {

    //                 $query->whereNull(trim($whereNull));

    //             }

    //         }else if($whereNulls) {

    //             $query->whereNull(trim($whereNulls));
    //         }

    //         $whereNotIns = $request->input('wherenotin');

    //         if (is_array($whereNotIns)) {
    //             foreach ($whereNotIns as $whereNotIn) {
    //                 $whereNotInArray = explode(',', $whereNotIn);
    //                 $whereNotInColumn = array_values($whereNotInArray)[0];
    //                 array_splice($whereNotInArray, 0, 1);

    //                 $query->whereNotIn($whereNotInColumn, $whereNotInArray);

    //             }

    //         }else if($whereNotIns) {
    //             $whereNotInArray = explode(',', $whereNotIns);
    //             $whereNotInColumn = trim(array_values($whereNotInArray)[0]);
    //             array_splice($whereNotInArray, 0, 1);

    //             $query->whereNotIn($whereNotInColumn, $whereNotInArray);

    //         }

    //         $whereRaws = $request->input('whereraw');

    //         if (is_array($whereRaws)) {
    //             foreach ($whereRaws as $whereRaw) {
    //                 $query->whereRaw($whereRaw);
    //             }
    //         }else if($whereRaws) {
    //             $query->whereRaw($whereRaws);

    //         }

    //         $joins = $request->input('join');

    //         if (is_array($joins)) {
    //             foreach ($joins as $join) {
    //                 $joinArray = explode(',', $join);

    //                 $query->join(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //             }

    //         }else if($joins) {
    //             $joinArray = explode(',', $joins);

    //             $query->join(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //         }

    //         $rightJoins = $request->input('rightjoin');

    //         if (is_array($rightJoins)) {
    //             foreach ($rightJoins as $rightjoin) {
    //                 $joinArray = explode(',', $rightjoin);

    //                 $query->rightJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //             }

    //         }else if($rightJoins) {
    //             $joinArray = explode(',', $rightJoins);

    //             $query->rightJoin(trim(array_values($joinArray)[0]), trim(array_values($joinArray)[1]), trim(array_values($joinArray)[2]), trim(array_values($joinArray)[3]));

    //         }

    //         $orderBys = $request->input('orderby');

    //         if (is_array($orderBys) & !$request->has(['start', 'length'])) {
    //             foreach ($orderBys as $orderBy) {
    //                 $orderByArray = explode(',', $orderBy);
    //                 if (isset(array_values($orderByArray)[1])){

    //                     $query->OrderBy(trim(array_values($orderByArray)[0]), trim(array_values($orderByArray)[1]));
    //                 }else {

    //                     $query->OrderBy(trim(array_values($orderByArray)[0]), 'ASC');
    //                 }

    //             }
    //         }else if($orderBys & !$request->has(['start', 'length'])) {
    //             $orderByArray = explode(',', $orderBys);
    //             if (isset(array_values($orderByArray)[1])){

    //                 $query->OrderBy(trim(array_values($orderByArray)[0]), trim(array_values($orderByArray)[1]));
    //             }else {

    //                 $query->OrderBy(trim(array_values($orderByArray)[0]), 'ASC');
    //             }

    //         }

    //         $orderByRaws = $request->input('orderbyraw');
    //         if (is_array($orderByRaws)) {

    //             foreach ($orderByRaws as $orderByRaw) {
    //                 $orderByArray = explode(',', $orderByRaw);
    //                 $query->OrderBy(DB::raw(trim(array_values($orderByArray)[0])),trim(array_values($orderByArray)[1]));
    //             }
    //         }else if($orderByRaws) {
    //             $orderByArray = explode(',', $orderByRaws);
    //             $query->OrderBy(DB::raw(trim(array_values($orderByArray)[0])),trim(array_values($orderByArray)[1]));

    //         }
    //         // return 'x';
    //         return $query;
    //         // });
    // }
}
