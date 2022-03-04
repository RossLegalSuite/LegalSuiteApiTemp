<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CreateModelAndControllersController extends Controller
{

    
    private function  addDateMutation($columnName)

    {

        $returnValue = "\n";
        $returnValue .= "\tpublic function set" . $columnName . "Attribute(\$value)\n";
        $returnValue .= "\t{\n";
        $returnValue .= "\t\t\$this->attributes['" . $columnName . "'] = \$value ? (String)ModelHelper::convertClarionDate(\$value) : '';\n";
        $returnValue .= "\t}\n";

        return $returnValue;


    }

    private function  addTimeMutation($columnName)

    {

        $returnValue = "\n";
        $returnValue .= "\tpublic function set" . $columnName . "Attribute(\$value)\n";
        $returnValue .= "\t{\n";
        $returnValue .= "\t\t\$this->attributes['" . $columnName . "'] = \$value ? (String)ModelHelper::convertClarionTime(\$value) : '';\n";
        $returnValue .= "\t}\n";

        return $returnValue;


    }

    public function CreateDateFormats(Request $request)
    {
        $tableList = $request->input('tables');
        // return $tableList;
        // strtolower();
        
        foreach ($tableList as $TableName) {
            $dataFormatFile = fopen("ModelsAndControllers/CreateDateFormats/CreateDateFormats".$TableName.".php", "w") or die("Unable to open file!");
            $getColumnNames =
            DB::connection('sqlsrv')
            ->table('INFORMATION_SCHEMA.COLUMNS')
            ->select('COLUMN_NAME')
            ->whereRaw(" (COLUMN_NAME LIKE '%date%' OR COLUMN_NAME LIKE '%to' OR COLUMN_NAME LIKE '%from') ")
            ->where('COLUMN_NAME', 'NOT LIKE', '%ID')
            ->where('DATA_TYPE', '=', 'int')
            ->where('TABLE_NAME', '=', $TableName)

            ->get();

            $getTimeColumnNames =
            DB::connection('sqlsrv')
            ->table('INFORMATION_SCHEMA.COLUMNS')
            ->select('COLUMN_NAME')
            ->whereRaw("(COLUMN_NAME LIKE '%time%') ")
            ->where('COLUMN_NAME', 'NOT LIKE', '%ID')
            ->where('DATA_TYPE', '=', 'int')
            ->where('TABLE_NAME', '=', $TableName)

            ->get();

            // return $getColumnNames;

            $dateFormatContent = "\t\tpublic static function ". $TableName ."SelectBuilder(&\$query)\n";
            $dateFormatContent .=  "\t\t{\n\n";
            
            $dateFormatContent .=  "\t\t\t\$query->addselect(\"". $TableName .".*\")\n";
            foreach ($getColumnNames as $ColumnName) {
                // return $ColumnName->COLUMN_NAME;
                $dateFormatContent .=  "\t\t\t->addselect(DB::raw(\"CASE WHEN ISNULL(".$TableName.".".$ColumnName->COLUMN_NAME.",0) = 0 OR ".$TableName.".".$ColumnName->COLUMN_NAME." = 0 OR ".$TableName.".".$ColumnName->COLUMN_NAME." > 100000 THEN '' ELSE  CONVERT(VarChar(12),CAST(".$TableName.".".$ColumnName->COLUMN_NAME."-36163 as DateTime),106) END AS Formatted".$ColumnName->COLUMN_NAME."\"))\n";
            }
            $dateFormatContent .=  "\n";
            $dateFormatContent .=  "\n";
            foreach ($getTimeColumnNames as $ColumnTimeName) {
                // return $ColumnName->COLUMN_NAME;
                $dateFormatContent .=  "\t\t\t->addselect(DB::raw(\"CASE WHEN ISNULL(".$TableName.".".$ColumnTimeName->COLUMN_NAME.",0) = 0 OR ".$TableName.".".$ColumnTimeName->COLUMN_NAME." = 0 THEN '' ELSE  CONVERT(VARCHAR,DateAdd(millisecond,(".$TableName.".".$ColumnTimeName->COLUMN_NAME." * 10) ,0),108) END AS Formatted".$ColumnTimeName->COLUMN_NAME."\"))\n";

            }
            $dateFormatContent .=  "\n";
            $dateFormatContent .=  "\t\t\treturn \$query;\n";
            $dateFormatContent .=  "\t\t}\n";
            $dateFormatContent .=  "\n";
            $dateFormatContent .=  "\n-------------------------------------------";
            $dateFormatContent .=  "\n";
            $dateFormatContent .= "\t\tif (\$TableName == '".$TableName."') {\n";
            $dateFormatContent .=  "\n";
            foreach ($getColumnNames as $ColumnName) {
                $dateFormatContent .= "\t\t\t\$classFileContent .= \$this->addDateMutation('".strtolower($ColumnName->COLUMN_NAME)."');\n";
            }
            foreach ($getTimeColumnNames as $ColumnTimeName) {
                $dateFormatContent .= "\t\t\t\$classFileContent .= \$this->addTimeMutation('".strtolower($ColumnTimeName->COLUMN_NAME)."');\n";
            }
            $dateFormatContent .=  "\n";
            $dateFormatContent .= "\t\t}\n";
            // if ($TableName == 'Matter') {
            //     $classFileContent .= $this->addDateMutation('prescriptiondate');

                fwrite($dataFormatFile, $dateFormatContent);
                
            }
            fclose($dataFormatFile);
            return $dateFormatContent ;
    }

    public function CreateApiRoutes(Request $request)
    {
        $tableList = $request->input('tables');
        $routeFileContent = "";
        foreach ($tableList as $TableName) {
        $recordID = [];


        $queryRecordID = DB::connection('sqlsrv')
        ->table('INFORMATION_SCHEMA.COLUMNS')
        ->select('COLUMN_NAME')
        ->where('TABLE_NAME', '=', $TableName)
        ->where('COLUMN_NAME', 'like', 'recordid')
        ->get();
        
        if ($queryRecordID->isEmpty()) {
            $queryRecordID =
            DB::connection('sqlsrv')
            ->table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
            ->select('COLUMN_NAME')
            ->whereRaw(" OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + QUOTENAME(CONSTRAINT_NAME)), 'IsPrimaryKey') = 1 ")
            ->where('TABLE_NAME', '=', $TableName)

            ->get();
        }

        foreach ($queryRecordID as $value) {
            $addValue = "'" . $value->COLUMN_NAME . "'";
            array_push($recordID, $addValue);
        }


        $query = DB::connection('sqlsrv')
        ->table('sys.columns')
        ->select('name as COLUMN_NAME')
        ->whereRaw('OBJECT_NAME(object_id) ='."'". $TableName."'")
        ->where('is_computed', '=', '0')
        ->get();
        
        $list = [];
        

        
        $doesTableHaveIdenityColumn =
        DB::connection('sqlsrv')
        ->table('sys.tables')
        ->select('sys.columns.name as ColumnName')
        ->leftJoin('sys.columns', 'sys.tables.object_id', '=', 'sys.columns.object_id')
        ->where('sys.columns.is_identity', '=', 1)
        ->where('sys.tables.name', '=', $TableName)
        ->limit(1)
        ->get();

        if ($doesTableHaveIdenityColumn->isEmpty()){
            $autoIncrementFlag = 0;
        }else {
            $autoIncrementFlag = 1;
        }


        $routeFileContent;
        foreach ($query as $value) {
            $addValue = "'" . strtolower($value->COLUMN_NAME) . "'";
            array_push($list, $addValue);
        }



        // return $tableList;
        $routeFile = fopen("ModelsAndControllers/CreateRoutes/CreateApiRoutes.php", "w") or die("Unable to open file!");
        // strtolower();
        
        
            // return $TableName;
            $routeFileContent .= "    Route::middleware('authenticate')->prefix('" . strtolower($TableName) . "')->group(function () {\n";
                // $routeFileContent .= "    Route::options('/', 'TableControllers\\" . $TableName . "Controller@options');\n"; //removed
                $routeFileContent .= "    Route::get('/', 'TableControllers\\" . $TableName . "Controller@index');\n";
                $routeFileContent .= "    Route::get('/parameters', 'TableControllers\\" . $TableName . "Controller@parameters');\n";
                // $routeFileContent .= "    Route::post('/', 'TableControllers\\" . $TableName . "Controller@store');\n";

                if(count($recordID) > 1){

                    $routeFileContent .= "    Route::post('";
                        foreach(array_reverse($recordID) as $value){
                            
                            $columnName = str_replace("'", "", strtolower($value));
                            $routeFileContent .= "/{".$columnName."?}";
                        }
                        $routeFileContent .= "', 'TableControllers\\" . $TableName . "Controller@store');\n";

                } else {

                    $routeFileContent .= "    Route::post('/{".str_replace("'", "", strtolower(implode(",\n", $recordID)))."?}', 'TableControllers\\" . $TableName . "Controller@store');\n";
                        // $columnName = str_replace("'", "*", strtolower(implode(",\n", $recordID)));

                }


                if(count($recordID) > 1){

                    $routeFileContent .= "    Route::get('";
                        foreach(array_reverse($recordID) as $value){
                            
                            $columnName = str_replace("'", "", strtolower($value));
                            $routeFileContent .= "/{".$columnName."}";
                        }
                        $routeFileContent .= "', 'TableControllers\\" . $TableName . "Controller@show');\n";

                } else {

                    $routeFileContent .= "    Route::get('/{".str_replace("'", "", strtolower(implode(",\n", $recordID)))."}', 'TableControllers\\" . $TableName . "Controller@show');\n";
                        // $columnName = str_replace("'", "*", strtolower(implode(",\n", $recordID)));

                }

                if(count($recordID) > 1){

                    $routeFileContent .= "    Route::put('";
                        foreach(array_reverse($recordID) as $value){
                            
                            $columnName = str_replace("'", "", strtolower($value));
                            $routeFileContent .= "/{".$columnName."}";
                        }
                        $routeFileContent .= "', 'TableControllers\\" . $TableName . "Controller@update');\n";

                } else {

                    $routeFileContent .= "    Route::put('/{".str_replace("'", "", strtolower(implode(",\n", $recordID)))."}', 'TableControllers\\" . $TableName . "Controller@update');\n";
                        // $columnName = str_replace("'", "*", strtolower(implode(",\n", $recordID)));

                }

                if(count($recordID) > 1){

                    $routeFileContent .= "    Route::delete('";
                        foreach(array_reverse($recordID) as $value){
                            
                            $columnName = str_replace("'", "", strtolower($value));
                            $routeFileContent .= "/{".$columnName."}";
                        }
                        $routeFileContent .= "', 'TableControllers\\" . $TableName . "Controller@delete');\n";

                } else {

                    $routeFileContent .= "    Route::delete('/{".str_replace("'", "", strtolower(implode(",\n", $recordID)))."}', 'TableControllers\\" . $TableName . "Controller@delete');\n";
                        // $columnName = str_replace("'", "*", strtolower(implode(",\n", $recordID)));

                }
                // $routeFileContent .= "    Route::get('/example', 'TableControllers\\" . $TableName . "Controller@example');\n";
                // $routeFileContent .= "    Route::delete('/{".str_replace("'", "", strtolower(implode(",\n", $recordID)))."}', 'TableControllers\\" . $TableName . "Controller@delete');\n";
                $routeFileContent .= "  });\n";
                $routeFileContent .= "        \n";
                
                
            }
            fwrite($routeFile, $routeFileContent);
            fclose($routeFile);
    }
        
        public function CreateModelAndControllers(Request $request)
        {

            // SCRIPT TO FIND TABLES WITHOUT IDENTITY 
    //         SELECT 
    // DB_NAME() AS Database_Name
    // ,sc.name AS Schema_Name
    // ,t.name AS Table_Name
    // FROM sys.tables t
    //     INNER JOIN sys.schemas sc 
    //         ON t.schema_id = sc.schema_id
    // WHERE OBJECTPROPERTY(t.object_id,'TableHasIdentity') = 0
    //     AND t.type = 'U'
    // ORDER BY t.name
            
            /*SELECT 
            col.is_identity as 'Auto Increment',		
            TableName = t.name,
            IndexName = ind.name,
            IndexId = ind.index_id,
            ColumnId = ic.index_column_id,
            ColumnName = col.name,
            --ind.*
            --ic.*
            col.* 
            FROM sys.indexes ind 
            INNER JOIN sys.index_columns ic ON  ind.object_id = ic.object_id and ind.index_id = ic.index_id 
            INNER JOIN sys.columns col ON ic.object_id = col.object_id and ic.column_id = col.column_id 
            INNER JOIN sys.tables t ON ind.object_id = t.object_id 
            WHERE 
            ind.name = 'PK_BRA:PrimaryKey'
            ORDER BY 
            t.name, ind.name, ind.index_id, ic.is_included_column, ic.key_ordinal;*/
            
            $tableList = $request->input('tables');
            
            //------
            // $recordID = [];
            // foreach ($tableList as $TableName) {
                
                //     $queryRecordID = DB::connection('sqlsrv')
                //         ->table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
                //         ->select('COLUMN_NAME')
                //         ->whereRaw(" OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + QUOTENAME(CONSTRAINT_NAME)), 'IsPrimaryKey') = 1 ")
                //         ->where('TABLE_NAME', '=', $TableName)
                //         ->limit(1)
                //     // ->where('COLUMN_NAME', 'like', 'recordid')
                //         ->get();
                
                //     // return $queryRecordID;
                //     if ($queryRecordID->isEmpty()) {
                    //         $queryRecordID = DB::connection('sqlsrv')
                    //             ->table('INFORMATION_SCHEMA.COLUMNS')
                    //             ->select('COLUMN_NAME')
                    //             ->where('TABLE_NAME', '=', $TableName)
                    //             ->where('COLUMN_NAME', 'like', 'recordid')
                    //             ->get();
                    //         return 'x' . $TableName . '-' . $queryRecordID;
                    //     }
                    //     foreach ($queryRecordID as $value) {
                        //         $addValue = $TableName . "'" . $value->COLUMN_NAME . "'";
                        //         array_push($recordID, $addValue);
                        //     }
                        // }
                        // return $recordID;
                        //-----

                foreach ($tableList as $TableName) {
                    
                    $recordID = [];

                        // SELECT
                //   name AS [Column],
                //   TYPE_NAME(user_type_id) AS [Data Type]
                // FROM sys.columns
                // WHERE OBJECT_NAME(object_id) = 'matter'
                // AND is_computed = 0;



                    // return $queryRecordID;

                    $queryRecordID = DB::connection('sqlsrv')
                    ->table('INFORMATION_SCHEMA.COLUMNS')
                    ->select('COLUMN_NAME')
                    ->where('TABLE_NAME', '=', $TableName)
                    ->where('COLUMN_NAME', 'like', 'recordid')
                    ->get();
                    
                    if ($queryRecordID->isEmpty()) {
                        $queryRecordID =
                        DB::connection('sqlsrv')
                        ->table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
                        ->select('COLUMN_NAME')
                        ->whereRaw(" OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + QUOTENAME(CONSTRAINT_NAME)), 'IsPrimaryKey') = 1 ")
                        ->where('TABLE_NAME', '=', $TableName)
                        // ->limit(1)
                        // ->where('COLUMN_NAME', 'like', 'recordid')
                        ->get();
                    }

                    // if ($queryRecordID->isEmpty()){
                    //     unset($tableList[$TableName]);
                    // }

                    // if ()
                    //     $queryRecordID = DB::connection('sqlsrv')
                    // ->table('INFORMATION_SCHEMA.COLUMNS')
                    // ->select('COLUMN_NAME')
                    // ->where('TABLE_NAME', '=', $TableName)
                    // ->where('COLUMN_NAME', 'like', 'recordid')
                    // ->get();
                    
                    // return $queryRecordID->COLUMN_NAME;
                    foreach ($queryRecordID as $value) {
                        $addValue = "'" . $value->COLUMN_NAME . "'";
                        array_push($recordID, $addValue);
                    }
                    // $query = DB::connection('sqlsrv')
                    // ->table('INFORMATION_SCHEMA.COLUMNS')
                    // ->select('COLUMN_NAME')
                    // ->where('TABLE_NAME', '=', $TableName)
                    // ->get();

                    $query = DB::connection('sqlsrv')
                    ->table('sys.columns')
                    ->select('name as COLUMN_NAME')
                    ->whereRaw('OBJECT_NAME(object_id) ='."'". $TableName."'")
                    ->where('is_computed', '=', '0')
                    ->get();
                    
                    $list = [];
                    
                    // $constraintName =
                    // DB::connection('sqlsrv')
                    // ->table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
                    // ->select('CONSTRAINT_NAME as name')
                    // ->whereRaw("OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + QUOTENAME(CONSTRAINT_NAME)), 'IsPrimaryKey') = 1 ")
                    // ->where('TABLE_NAME', '=', $TableName)
                    // ->limit(1)
                    // ->get();


                        
                    //  if (isset($constraintName[0]->name))
                    //  {
                    //     $autoIncrement =
                    //     DB::connection('sqlsrv')
                    //     ->table('sys.indexes as ind')
                    //     ->select('col.is_identity as flag')
                    //     ->join('sys.index_columns as ic', function ($join) {
                    //         $join->whereRaw('ind.object_id = ic.object_id')
                    //         ->whereRaw('ind.index_id = ic.index_id');
                    //     })
                    //     ->join('sys.columns as col', function ($join) {
                    //         $join->whereRaw('ic.object_id = col.object_id')
                    //         ->whereRaw('ic.column_id = col.column_id');
                    //     })
                    //     ->where('ind.name', '=', $constraintName[0]->name)
                    //     ->limit(1)
                    //     ->get();
                    //     return $autoIncrement;
                    //     $autoIncrementFlag = $autoIncrement[0]->flag;
                    //  }else{
                    //     // $autoIncrement = [];
                    //     $autoIncrementFlag = '0';
                    //  } 
                        
                    //  return $autoIncrement;
                    
                    $doesTableHaveIdenityColumn =
                    DB::connection('sqlsrv')
                    ->table('sys.tables')
                    ->select('sys.columns.name as ColumnName')
                    ->leftJoin('sys.columns', 'sys.tables.object_id', '=', 'sys.columns.object_id')
                    ->where('sys.columns.is_identity', '=', 1)
                    ->where('sys.tables.name', '=', $TableName)
                    ->limit(1)
                    ->get();

                    if ($doesTableHaveIdenityColumn->isEmpty()){
                        $autoIncrementFlag = 0;
                    }else {
                        $autoIncrementFlag = 1;
                    }
                
                    //  return '$autoIncrementFlag = ' .$autoIncrementFlag .'---- $doesTableHaveIdenityColumn = '. $doesTableHaveIdenityColumn[0]->ColumnName;
                    // return '$autoIncrementFlag = ' .$autoIncrementFlag .'---- $autoIncrementFlag2 = '. $autoIncrementFlag2;


                    foreach ($query as $value) {
                        $addValue = "'" . strtolower($value->COLUMN_NAME) . "'";
                        array_push($list, $addValue);
                    }


                    
                    $classFile = fopen("ModelsAndControllers/CreatedModels/" . strtolower($TableName) . ".php", "w") or die("Unable to open file!");
                    
                    $classFileContent = "<?php\n";
                    $classFileContent .= "\n";
                    $classFileContent .= "namespace App\TableModels;\n";
                    $classFileContent .= "\n";
                    $classFileContent .= "use Illuminate\Database\Eloquent\Model;\n";
                    $classFileContent .= "use App\Custom\ModelHelper;\n";
                    $classFileContent .= "\n";
                    $classFileContent .= "class " . strtolower($TableName) . " extends Model\n";
                    $classFileContent .= "{\n";
                    $classFileContent .= "\n";
                    
                    if (count($recordID) == 1) {
                            // return count($recordID);
                            $classFileContent .= "    protected \$primaryKey = " . implode(",\n", $recordID) . ";\n";
                            
                        } else if (is_array($recordID)){
                
                            $classFileContent .= "    protected \$primaryKey = [" . implode(",", $recordID) . "];\n";
                        } else  if (!empty($recordID)) {
                            $classFileContent .= "    protected \$primaryKey = " . implode(",\n", $recordID) . ";\n";
                        }// else {
                        //    return 'Error on: '.$TableName;
                        //}
                        $classFileContent .= "    protected \$table = '" . $TableName . "';\n";
                        $classFileContent .= "    protected \$connection = 'sqlsrv';\n";
                        $classFileContent .= "    public \$timestamps = false;\n";
                        $classFileContent .= "    public \$incrementing = " . (boolval($autoIncrementFlag) ? 'true' : 'false'). ";\n";
                        $classFileContent .= "    protected \$fillable = [\n";
                        $classFileContent .= "\t\t\t\t\t\t\t" . implode(",\n\t\t\t\t\t\t\t", $list);
                        $classFileContent .= "\n";
                        $classFileContent .= "    ];\n";
                        $classFileContent .= "\n";
                        $classFileContent .= "\tpublic function setdateAttribute(\$value)\n";
                        $classFileContent .= "\t{\n";
                        $classFileContent .= "\t\t\$this->attributes['date'] = \$value ? (String)ModelHelper::convertClarionDate(\$value) : '';\n";
                        $classFileContent .= "\t}\n";
                        $classFileContent .= "\n";
                        $classFileContent .= "\tpublic function setcreateddateAttribute(\$value)\n";
                        $classFileContent .= "\t{\n";
                        $classFileContent .= "\t\t\$this->attributes['createddate'] = \$value ? (String)ModelHelper::convertClarionDate(\$value) : '';\n";
                        $classFileContent .= "\t}\n";

                        if ($TableName == 'Matter') {
                            $classFileContent .= $this->addDateMutation('prescriptiondate');
                            $classFileContent .= $this->addDateMutation('dateinstructed');
                            $classFileContent .= $this->addDateMutation('lastinvoicedate');
                            $classFileContent .= $this->addDateMutation('loddate');
                            $classFileContent .= $this->addDateMutation('summonsdate');
                            $classFileContent .= $this->addDateMutation('returnofservicedate');
                            $classFileContent .= $this->addDateMutation('rdjdate');
                            $classFileContent .= $this->addDateMutation('judgmentdate');
                            $classFileContent .= $this->addDateMutation('writdate');
                            $classFileContent .= $this->addDateMutation('s65date');
                            $classFileContent .= $this->addDateMutation('interestenddate');
                            $classFileContent .= $this->addDateMutation('emodate');
                            $classFileContent .= $this->addDateMutation('dateofdebt');
                            $classFileContent .= $this->addDateMutation('storagedate');
                            $classFileContent .= $this->addDateMutation('storagetakenoutdate');
                            $classFileContent .= $this->addDateMutation('storagereturndate');
                            $classFileContent .= $this->addDateMutation('lastdebtorreceiptdate');
                            $classFileContent .= $this->addDateMutation('lastclientreceiptdate');
                            $classFileContent .= $this->addDateMutation('laststatementdate');
                            $classFileContent .= $this->addDateMutation('archivedate');
                            $classFileContent .= $this->addDateMutation('s57date');
                            $classFileContent .= $this->addDateMutation('datewithdrawn');
                            $classFileContent .= $this->addDateMutation('receiptpercenttodate');
                            $classFileContent .= $this->addDateMutation('importantdate');
                            $classFileContent .= $this->addDateMutation('interestfrom');
                            $classFileContent .= $this->addDateMutation('updatedbydate');
                            $classFileContent .= $this->addDateMutation('canceltoreassigndate');
                            $classFileContent .= $this->addDateMutation('laststagedate');
                            $classFileContent .= $this->addTimeMutation('updatedbytime');

                        }
                        if ($TableName == 'Party') {

                            $classFileContent .= $this->addDateMutation('lastcontactdate');
                            $classFileContent .= $this->addDateMutation('firstcontactdate');
                            $classFileContent .= $this->addDateMutation('updatedbydate');
                            $classFileContent .= $this->addDateMutation('lastinstructeddate');
                            $classFileContent .= $this->addDateMutation('lastbirthdayeventdate');
                            $classFileContent .= $this->addDateMutation('ficarequestdate');
                            $classFileContent .= $this->addDateMutation('dateresolutionsigned');
                            $classFileContent .= $this->addTimeMutation('updatedbytime');
                            $classFileContent .= $this->addTimeMutation('createdtime');
                        }
                        
                        if ($TableName == 'FileNote') {
                            
                            // $classFileContent .= $this->addDateMutation('date');
                            $classFileContent .= $this->addDateMutation('autonotifydate');
                            // $classFileContent .= $this->addDateMutation('createddate');
                        }
                        
                        if ($TableName == 'FeeNote') {
                            
                            // $classFileContent .= $this->addDateMutation('date');
                            $classFileContent .= $this->addDateMutation('posteddate');
                        }

                        if ($TableName == 'ToDoNote') {

                            $classFileContent .= $this->addDateMutation('datedone');
                            $classFileContent .= $this->addDateMutation('autonotifydate');
                            $classFileContent .= $this->addDateMutation('dateadjustment');
                        }

                        if ($TableName == 'DocLog') {

                            $classFileContent .= $this->addDateMutation('datedone');
                            $classFileContent .= $this->addDateMutation('autonotifydate');
                            $classFileContent .= $this->addDateMutation('dateadjustment');
                        }
                        
                        if ($TableName == 'MatParty') {
                            
                            $classFileContent .= $this->addDateMutation('effectivedate');
                        }

                        if ($TableName == 'MatActiv') {

                        }

                        if ($TableName == 'ColData') {

                            $classFileContent .= $this->addDateMutation('aoddate');
                            $classFileContent .= $this->addDateMutation('emointerestto');
                            $classFileContent .= $this->addDateMutation('ccjinterestto');
                            $classFileContent .= $this->addDateMutation('ccjinterestfrom');
                            $classFileContent .= $this->addDateMutation('emointerestfrom');
                            $classFileContent .= $this->addDateMutation('chequedate');
                            $classFileContent .= $this->addDateMutation('emodate');
                            $classFileContent .= $this->addDateMutation('emofirstdate');
                            $classFileContent .= $this->addDateMutation('judgmentdate');
                            $classFileContent .= $this->addDateMutation('loddatetorespond');
                            $classFileContent .= $this->addDateMutation('r41lastdate');
                            $classFileContent .= $this->addDateMutation('r41newdate');
                            $classFileContent .= $this->addDateMutation('rdjinterestfromdate');
                            $classFileContent .= $this->addDateMutation('movsaledate');
                            $classFileContent .= $this->addDateMutation('immsaledate');
                            $classFileContent .= $this->addDateMutation('s57interestfrom');
                            $classFileContent .= $this->addDateMutation('s57interestto');
                            $classFileContent .= $this->addDateMutation('s57firstpaymentdate');
                            $classFileContent .= $this->addDateMutation('s65date');
                            $classFileContent .= $this->addDateMutation('s65firstpaymentdate');
                            $classFileContent .= $this->addDateMutation('s65interestfrom');
                            $classFileContent .= $this->addDateMutation('s65interestto');
                            $classFileContent .= $this->addDateMutation('wriinterestto');
                            $classFileContent .= $this->addDateMutation('rewriinterestto');
                            $classFileContent .= $this->addDateMutation('res65interestto');
                            $classFileContent .= $this->addDateMutation('reemointerestto');
                            $classFileContent .= $this->addDateMutation('wriinterestfrom');
                            $classFileContent .= $this->addDateMutation('rewriinterestfrom');
                            $classFileContent .= $this->addDateMutation('res65interestfrom');
                            $classFileContent .= $this->addDateMutation('reemointerestfrom');
                            $classFileContent .= $this->addDateMutation('courtdate');
                            $classFileContent .= $this->addDateMutation('applicationdate');
                            $classFileContent .= $this->addDateMutation('paymentdate');
                            $classFileContent .= $this->addDateMutation('lastinstallmentdate');
                            $classFileContent .= $this->addDateMutation('nextinstallmentdate');
                            $classFileContent .= $this->addDateMutation('ptpstartdate');
                            $classFileContent .= $this->addDateMutation('newinduplumrulefromdate');
                            $classFileContent .= $this->addDateMutation('emoreturnofservicedate');
                            $classFileContent .= $this->addDateMutation('reemoreturnofservicedate');
                            $classFileContent .= $this->addDateMutation('emoenddate');
                            $classFileContent .= $this->addDateMutation('feesuntildate');
                            $classFileContent .= $this->addDateMutation('commissionuntildate');
                            $classFileContent .= $this->addDateMutation('lastpaymentdate');
                            $classFileContent .= $this->addDateMutation('nextpaymentdate');
                
                        }

                        if ($TableName == 'ParFica') {

                            // $classFileContent .= $this->addDateMutation('date');
                
                        }
                        
                        $classFileContent .= "\n";
                        $classFileContent .= "}\n";
                        $classFileContent .= "        \n";
                        
                        fwrite($classFile, $classFileContent);
                        
                        fclose($classFile);
                         // No longer creating.
                        // $controllerFile = fopen("ModelsAndControllers/CreatedControllers/" . $TableName . "Controller.php", "w") or die("Unable to open file!");
                        
                        $controllerFileContent = "<?php\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "namespace App\Http\Controllers\TableControllers;\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "use App\GenericTableModels\\" . $TableName . ";\n";
                        $controllerFileContent .= "use App\Http\Controllers\Controller;\n";
                        $controllerFileContent .= "use App\Custom\ControllerHelper;\n";
                        $controllerFileContent .= "use App\Custom\QueryBuilder;\n";
                        $controllerFileContent .= "use App\Custom\BusinessRulesController;\n";
                        $controllerFileContent .= "use App\Custom\ParameterBuilder;\n";
                        $controllerFileContent .= "use DB;\n";
                        $controllerFileContent .= "use Illuminate\Http\Request;\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "class " . $TableName . "Controller extends Controller\n";
                        $controllerFileContent .= "{\n";
                        $controllerFileContent .= "\n";
                        
                        $controllerFileContent .= "    public function index(Request \$request)\n";
                        $controllerFileContent .= "    {\n";
                        $controllerFileContent .= "        return ControllerHelper::tryCatch(\$request, function (\$request) {\n";
                        $controllerFileContent .= "    \n";
                        $controllerFileContent .= "\t\t\t\$query = DB::connection('sqlsrv')->table('" . $TableName . "');\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tParameterBuilder::ParameterBuilder(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\QueryBuilder', '" . $TableName . "JoinBuilder') & !\$request->input('removejoinbuilder')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\tQueryBuilder::" . $TableName . "JoinBuilder(\$query);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} \n";
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\QueryBuilder', '" . $TableName . "SelectBuilder') & !\$request->input('select') & !\$request->input('selectraw') & !\$request->input('columnraw') & !\$request->input('column')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\tQueryBuilder::" . $TableName . "SelectBuilder(\$query);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} else if (!\$request->input('select') & !\$request->input('selectraw') & !\$request->input('columnraw') & !\$request->input('column')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\t\$query->addselect('" . $TableName . ".*');\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} \n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tif (\$request->input('method')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\treturn ControllerHelper::MethodHelper(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t}\n";
                        $controllerFileContent .= "\t\t\treturn ControllerHelper::DataFormatHelper(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t});\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "    }\n";
                        $controllerFileContent .= "\n";

                        if(count($recordID) > 1){

                            $controllerFileContent .= "    public function parameters(Request \$request)\n";
                            $controllerFileContent .= "    {\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "        return \"".$TableName;
                            foreach(array_reverse($recordID) as $value){
                                // return $value;
                                $columnName = str_replace("'", "*", strtolower($value));
                                $controllerFileContent .= "/$columnName";

                            }
                            $controllerFileContent .= "\";\n";
                            $controllerFileContent .= "    }\n";
                            $controllerFileContent .= "\n";
                        } else {

                            $controllerFileContent .= "    public function parameters(Request \$request)\n";
                            $controllerFileContent .= "    {\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "        return \"".$TableName;
                            $controllerFileContent .= "/".str_replace("'", "*", strtolower(implode(",", $recordID)))."\";";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "";
                            $controllerFileContent .= "    }\n";
                            $controllerFileContent .= "\n";

                        }

                        $controllerFileContent .= "\tpublic function show(Request \$request)\n";
                        $controllerFileContent .= "\t{\n";
                        $controllerFileContent .= "\t\treturn ControllerHelper::tryCatch(\$request, function (\$request) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\$query = DB::connection('sqlsrv')\n";
                        $controllerFileContent .= "\t\t\t->table('" . $TableName . "');\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tParameterBuilder::ParameterBuilder(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\QueryBuilder', '" . $TableName . "JoinBuilder') & !\$request->input('removejoinbuilder')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\tQueryBuilder::" . $TableName . "JoinBuilder(\$query);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} \n";
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\QueryBuilder', '" . $TableName . "SelectBuilder') & !\$request->input('select') & !\$request->input('selectraw') & !\$request->input('columnraw') & !\$request->input('column')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\tQueryBuilder::" . $TableName . "SelectBuilder(\$query);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} else if (!\$request->input('select') & !\$request->input('selectraw') & !\$request->input('columnraw') & !\$request->input('column')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\$query->addselect('" . $TableName . ".*');\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} \n";
                        $controllerFileContent .= "\n";

                        
                        if(count($recordID) === 1){
                            // return parent::setKeysForSaveQuery($query);
                            $columnName = str_replace("'", "", strtolower(implode(",\n", $recordID)));
                            $controllerFileContent .= "\t\t\t\$query->where('" . $TableName . ".".$columnName."', \$request->".$columnName.");\n";
                        } else {
                
                            foreach($recordID as $value){
                                $columnName = str_replace("'", "", strtolower($value));
                                $controllerFileContent .= "\t\t\t\$query->where('" . $TableName . ".".$columnName."', \$request->".$columnName.");\n";
                            }
                        }

                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tif (\$request->input('method')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\t\treturn ControllerHelper::MethodHelper(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t}\n";
                        $controllerFileContent .= "\n";
                        
                        $controllerFileContent .= "\t\t\treturn ControllerHelper::DetailFormatHelper(\$query, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t});\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t}\n";
                        $controllerFileContent .= "\n";

                        $controllerFileContent .= "    public function store(Request \$request)\n";
                        $controllerFileContent .= "    {\n";
                        $controllerFileContent .= "        return ControllerHelper::tryCatch(\$request, function (\$request) {\n";
                        if(count($recordID) === 1 ){
                            // $controllerFileContent .= "\t\t\t".($autoIncrementFlag ? '//' : ''). "unset(\$request['".strtolower($columnName)."']);\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t".($autoIncrementFlag ? '//' : ''). "if (!\$request['".strtolower($columnName)."']) {\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t\t".($autoIncrementFlag ? '//' : ''). "$".strtolower($columnName)." = " . $TableName . "::max('".strtolower($columnName)."');\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t\t".($autoIncrementFlag ? '//' : ''). "\$request['".strtolower($columnName)."'] = \$".strtolower($columnName)." + 1;\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t".($autoIncrementFlag ? '//' : '')."}\n";
                            $controllerFileContent .= "\n";
                        }
                        $controllerFileContent .= "            \$requestData = \$request->all();\n";

                        $controllerFileContent .= "\n";

                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\BusinessRulesController', 'Store" . $TableName . "')) {\n";
                        $controllerFileContent .= "\n";

                        $controllerFileContent .= "\t\t\t\t\$businessRulesController = new BusinessRulesController;\n";
                        $controllerFileContent .= "\t\t\t\t\$recordData = \$businessRulesController->Store" . $TableName . "(\$requestData);\n";

                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} else { \n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\t\$recordData = " . $TableName . "::create(\$requestData);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t}";
                        $controllerFileContent .= "\n";

                        $controllerFileContent .= "\n\t\t\tif ( isset(\$request->loggedinemployeeid)) {";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper = new ControllerHelper;";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper->addEmployeeLogFile(\$request, '" . $TableName . "', 'Store');";
                        $controllerFileContent .= "\n\t\t\t}";
            
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\n\t\treturn ControllerHelper::PostPutDeleteFormatHelper(\$recordData, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "        });\n";
                        $controllerFileContent .= "    }\n";
                        $controllerFileContent .= "    public function update(Request \$request)\n";
                        $controllerFileContent .= "    {\n";
                        $controllerFileContent .= "        return ControllerHelper::tryCatch(\$request, function (\$request) {\n";
                        $controllerFileContent .= "\n";

                    
                    $controllerFileContent .= "\t\t\t\$requestData = \$request->all();\n";
                    $controllerFileContent .= "\n";

                    foreach($recordID as $value){
                        $controllerFileContent .= "\t\t\tif (!array_key_exists(".strtolower($value).", \$requestData)) \$requestData[".strtolower($value)."] = \$request->".str_replace("'", "", strtolower($value)).";\n";
                    }

                    $controllerFileContent .= "\n";

                    if(count($recordID) === 1){

                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\BusinessRulesController', 'Update" . $TableName . "')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\t\$businessRulesController = new BusinessRulesController;\n";
                        $controllerFileContent .= "\t\t\t\t\$recordData = \$businessRulesController->Update" . $TableName . "(\$requestData);\n";

                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} else { \n";
                        $controllerFileContent .= "\n";
                        
                            // return parent::setKeysForSaveQuery($query);
                            $columnName = str_replace("'", "", strtolower(implode(",\n", $recordID)));
                            $controllerFileContent .= "\t\t\t\t\$recordData = " . $TableName . "::findOrFail(\$requestData[".strtolower(implode(",\n", $recordID))."]);\n";

                        $controllerFileContent .= "\t\t\t\tunset(\$requestData[".strtolower(implode(",\n", $recordID))."]);\n";
                        $controllerFileContent .= "\t\t\t\t\$recordData->update(\$requestData);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} \n";
                        
                        $controllerFileContent .= "\n\t\t\tif ( isset(\$request->loggedinemployeeid)) {";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper = new ControllerHelper;";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper->addEmployeeLogFile(\$request, '" . $TableName . "', 'Update');";
                        $controllerFileContent .= "\n\t\t\t}";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\treturn ControllerHelper::PostPutDeleteFormatHelper(\$recordData, \$request);\n";
                        
                    } else {

                            
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\BusinessRulesController', 'Update" . $TableName . "')) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\t\$businessRulesController = new BusinessRulesController;\n";
                        $controllerFileContent .= "\t\t\t\t\$recordData = \$businessRulesController->Update" . $TableName . "(\$requestData);\n";

                        // $controllerFileContent .= "\t\t\t\t\$recordData = BusinessRulesController::Update" . $TableName . "(\$requestData);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t} else { \n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\$recordData = DB::connection('sqlsrv')->table('$TableName');\n";
                        $controllerFileContent .= "\t\t\t\$recordData";
                        
                            foreach($recordID as $value){
                                
                                $columnName = str_replace("'", "", strtolower($value));

                                $controllerFileContent .= "->where(\"$TableName."."$columnName\",\$requestData['".strtolower($columnName)."'])";
                        
                            }
                        $controllerFileContent .= ";\n";
                            
                            
                            foreach($recordID as $value){
                                $controllerFileContent .= "\t\t\tunset(\$requestData[".strtolower($value)."]);\n";             
                            }
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t\$recordData->update(\$requestData);\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t} \n";
                            
                            $controllerFileContent .= "\n\t\t\tif ( isset(\$request->loggedinemployeeid)) {";
                            $controllerFileContent .= "\n\t\t\t\t\$controllerHelper = new ControllerHelper;";
                            $controllerFileContent .= "\n\t\t\t\t\$controllerHelper->addEmployeeLogFile(\$request, '" . $TableName . "', 'Update');";
                            $controllerFileContent .= "\n\t\t\t}";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\n";

                        $controllerFileContent .= "\t\t\treturn ControllerHelper::DetailFormatHelper(\$recordData, \$request);\n";
                        
                    }

                    $controllerFileContent .= "        });\n";
                    $controllerFileContent .= "    }\n";
                    $controllerFileContent .= "\n";
                    $controllerFileContent .= "    public function delete(Request \$request)\n";
                    $controllerFileContent .= "    {\n";
                    $controllerFileContent .= "        return ControllerHelper::tryCatch(\$request, function (\$request) {\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t\$requestData = \$request->all();\n";
                        $controllerFileContent .= "\n";
                        foreach($recordID as $value){
                        $controllerFileContent .= "\t\t\tif (!array_key_exists(".strtolower($value).", \$requestData)) \$requestData[".strtolower($value)."] = \$request->".str_replace("'", "", strtolower($value)).";\n";
                        }
                        $controllerFileContent .= "\n";
                        
                        $controllerFileContent .= "\t\t\tif (method_exists('App\Custom\BusinessRulesController', 'Delete" . $TableName . "')) {\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t\t\$businessRulesController = new BusinessRulesController;\n";
                            $controllerFileContent .= "\t\t\t\t\$recordData = \$businessRulesController->Delete" . $TableName . "(\$requestData);\n";

                            // $controllerFileContent .= "\t\t\t\t\$recordData = BusinessRulesController::Delete" . $TableName . "(\$requestData);\n";
                            $controllerFileContent .= "\n";
                            $controllerFileContent .= "\t\t\t} else { \n";
                            $controllerFileContent .= "\n";
                        if(count($recordID) === 1){
                            // return parent::setKeysForSaveQuery($query);
                            $columnName = str_replace("'", "", strtolower(implode(",\n", $recordID)));
                            $controllerFileContent .= "\t\t\t\t\$recordData = " . $TableName . "::findOrFail(\$requestData['".strtolower($columnName)."'])->delete();\n";
                        } else {
                            $controllerFileContent .= "            \$recordData = DB::connection('sqlsrv')->table('$TableName');\n";
                            $controllerFileContent .= "\t\t\t\t\$recordData";
                            foreach($recordID as $value){
                                
                                $columnName = str_replace("'", "", strtolower($value));

                                $controllerFileContent .= "->where(\"$TableName."."$columnName\",\$requestData['".strtolower($columnName)."'])";
                            
                            }
                            $controllerFileContent .= "->delete();\n";
                        }

                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\t}\n";
                        
                        $controllerFileContent .= "\n\t\t\tif ( isset(\$request->loggedinemployeeid)) {";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper = new ControllerHelper;";
                        $controllerFileContent .= "\n\t\t\t\t\$controllerHelper->addEmployeeLogFile(\$request, '" . $TableName . "', 'Delete');";
                        $controllerFileContent .= "\n\t\t\t}";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "\t\t\treturn ControllerHelper::PostPutDeleteFormatHelper(\$recordData, \$request);\n";
                        $controllerFileContent .= "\n";
                        $controllerFileContent .= "        });\n";
                        $controllerFileContent .= "    }\n";
                        $controllerFileContent .= "}\n";
                        $controllerFileContent .= "\n";
                        // No longer creating.
                        // fwrite($controllerFile, $controllerFileContent);
                        
                        // fclose($controllerFile);
                        
                    }
                    // return $arr;
                    return 'success';
                }
                
            }
        
            //script
            // DECLARE @dbid int
            // SELECT @dbid = db_id('legalsuite')
            
            // SELECT TableName = object_name(s.object_id),
            //        Reads = SUM(user_seeks + user_scans + user_lookups), Writes =  SUM(user_updates)
            // FROM sys.dm_db_index_usage_stats AS s
            // INNER JOIN sys.indexes AS i
            // ON s.object_id = i.object_id
            // AND i.index_id = s.index_id
            // WHERE objectproperty(s.object_id,'IsUserTable') = 1
            // AND s.database_id = @dbid
            // AND object_name(s.object_id) Not in ( 'matter','employee','filenote','todonote','feenote','party','doclog','matparty','costcentre','docgen','branch','mattype','planofaction','partele','role','entity','partype','grouping','matactiv','control','absa_mattermessage','bondprop','employeelogfile','mattran','proformaheader','propertyhub','stage','regsect','regarea','matterstages','parlang','law_trans','doclogcategory','business','bonddata','coldebit','conveydata','ag_mattermessage','bondabsa','bondcession','billnote','bondarea','bondcanc','absainst','absapayment','activity','battran','absa_messagesreceived','absafees','absadata','colrent','checksheetscreen','claim','bonddebit','bonddeposit','bondfnb','bondguar','bondshare','bondsure','canc_mattermessage','electroniclinklog','empactivity','employeesms','eventlog','coldata','doclogattachment','devprop','docchecklist','criticalerrors','liquidation','liquidationtype','mattranhis','messagesreceived','messagestosend','matdocsc','matempbilling','matemployee','matfield','matgroup','matinv','matpartyheldback','finalaccount','estate','invoice','invoicematter','law_acond','law_agency','law_deposit','law_bond','law_ccond','law_mattr','law_party','law_pcond','law_prop','law_suite','law_tier','matterspecialinstruction','parfield','lawmattermessage','notification','parrolsc','repemp','rafclaim','rafdata','rates_bondpropmessage','servicescript','regbond','task','tblunusedindexes','timedfee','tblmissingindexes','todoitemevent','trademark','trademarkscreen','tokendata','tokendata_n','townshipdata','versionlog','vresult','webpage','widgetbackgrounds','xpobjecttype','tradeclass','township','tradetype','trancost','trandefs','trantarr','trantype','unit','unittext','upgradelog','varfile','variable','varlang','todoitemgroup','todotext','tblmostusedindexes','todogroup','todoitem','todoitemcondition','telecall','teletype','temp_employee','tempfile','test','test_table','test_table_2','test_table_3','thoughts','tblindexusageinfo','relationship','relationshiplang','remit','repcol','repcustom','stageevent','stagegroup','tagfilepos_','taggedmatter','taggedstage','tally','tariff','tariffhead','session','sessiontype','settings','sheriffarea','signingsessiondocument','signingsessions','simpleuser','smalliconlist','smslog','rates_message','rates_messagesreceived','ratetype','rc','receiptlog','reconerror','reconstatement','repempplanofaction','repempstage','repfile','repgroup','replink','report','reportcol','reportemp','reportfield','reportfile','reportlayout','reportscreen','repscreen','repset','reptotal','rolelang','rolescrn','rpt','rssemployee','safelog','safetype','sars_mattermessage','searchworksdoclog','searchworkslogfile','searchworkstariff','secfield','secgroup','secproc','security','parshare','parsign','partygrouping','ph_mattermessage','ph_message','ph_messagestosend','planitem','precedentbank','precedentdoc','product','province','ptpmessagelog','ptypedef','qbedetail','qbeheader','qbereport','proformasummary','pronoun','prontext','notificationgroup','notificationlang','notificationlist','outlookaddinlog','parcategory','parfica','lawmessagechild','lawmessageparent','lgltrax','library','licensed','linkeddocument','parfilenote','pargroup','parproduct','parproductscreen','parregion','parrel','law_messg','law_ctl','law_docs','law_ftran','law_intrates','law_locauth','law_auto','law_autoheader','invoicesetup','jobapplication','language','estatedistribution','event','eventgroup','finaldefs','finyear','fnbinstalment','fnbrepayment','futuretask','guaranteehubrequestattachment','guaranteehubrequestcomment','guaranteehubrequestsreceived','guaranteehubrequestssent','holiday','iconlist','intrateperiod','intrateschedule','matterchecklist','mattercondition','messagetemplate','moduleinfo','ned_messagesreceived','nedbrand','nedctl','nedinst','notice','lm','logfile','lollang','lollogfile','lookupemployer','lswmon','lswmontype','matdef','matdefparty','lawdeed_bank','lawdeed_control','lawdeed_deedsoffice','lawdeed_instructingfirm','lawdeed_instructingparalegal','lawdeed_lodgingfirm','lawdeed_lodgingparalegal','lawdeed_logfile','lawdeed_mattertype','lawdeed_mortgageoriginator','lawdeed_progress','criticalstep','crystalreport','custominvoice','customqbefield','customreportfield','customreports','datalinksynclog','deaddescription','deadmatter','deadmattran','debitorder','deletedlawtranslog','delivery','deliveryfeecode','descript','docdebit','docdef','docdisplaycriteria','docevent','docfilenote','docgendebit','docgenempalloc','doclang','dgenlang','distribution','doccategory','conveyancingdiscountlog','exportlog','extrafld','favouritereport','favourites','feecode','feeitem','feelink','feescale','feesheet','feetext','ficaitem','field','fieldvar','filenotearchive','empmessage','empnotice','empprinter','emprole','emptaggeddocuments','emptaggedmatters','emptype','empworkgroup','endorsement','entityfica','entitylang','errors','empalert','empallow','empautodebiting','empfilter','empdgloc','empdisplaysettings','emplh','emplinkrole','emploggedin','employeebillingrate','docmergequeue','docscrn','docscrnevent','docscrnfield','doctodoitem','document','documentcategories','documentextrascreen','ehcollections','electronicchangelog','cancdefs','checklist','checksheet','bustran','bustranrecon','bondsecondary','bondtarr','bondtype','branchlang','busgroup','bonddefs','clause','colcost','coldebitbackup','coldebittemp','coldef','color','coltable','coltext','coltitem','commissionrate','consenttype','cosgroup','country','creditor','cregroup','cretran','absadb','absadocs','absaenq','absafldh','absaflds','absactl','ag_message','appearer','assetreg','attorneyclassification','backupdata','bankcode','bankrec','bathead','billingrate','actlang','ag_documentnames','accbank','absapartyindicators','bondcause','bondcausedetails','birthdaymessagelog','bondcessiontype','bondcost'  )
            // GROUP BY object_name(s.object_id)
            // ORDER BY reads DESC
                                                            