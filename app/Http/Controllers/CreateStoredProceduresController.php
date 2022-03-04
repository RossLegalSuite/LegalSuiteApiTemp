<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CreateStoredProceduresController extends Controller
{

    public function CreateStoredProcedureRoutes(Request $request)
    {
        
        $listOfSP = DB::connection('sqlsrv')
        ->table('sysobjects')
        ->select('NAME')
        ->where('TYPE', '=', 'P')
        ->where('CATEGORY', '=', '0')
        ->get();

        $listOfSP = DB::connection('sqlsrv')
        ->table('sys.schemas')
        ->addselect('sys.schemas.name')
        ->addselect('sys.procedures.NAME')
        ->addselect('sys.sql_modules.definition')
        ->Join('sys.procedures', 'sys.schemas.schema_id', '=', 'sys.procedures.schema_id')
        ->Join('sys.sql_modules', 'sys.procedures.object_id', '=', 'sys.sql_modules.object_id')

        ->get();
        
        


        $routeFile = fopen("ModelsAndControllers/CreateRoutes/CreateStoredProcedureRoutes.php", "w") or die("Unable to open file!");
        $routeFileContent = "\n";
        foreach ($listOfSP as $SP) {

            $routeFileContent .= "\tRoute::middleware('authenticate')->prefix('storedprocedure')->group(function () {\n";
            
            $routeFileContent .= "\tRoute::get('/" . strtolower($SP->NAME) . "', 'StoredProcedureControllers\\" . $SP->NAME . "Controller@parameters');\n";
            $routeFileContent .= "\tRoute::post('/" . strtolower($SP->NAME) . "', 'StoredProcedureControllers\\" . $SP->NAME . "Controller@execute');\n";
            $routeFileContent .= "\n";
            $routeFileContent .= "\t});\n";
            $routeFileContent .= "\n";
        }

        fwrite($routeFile, $routeFileContent);
        fclose($routeFile);

    }
        
    public function CreateStoredProcedureControllers(Request $request)
    {
        $listOfSP = DB::connection('sqlsrv')
        ->table('sysobjects')
        ->select('NAME')
        ->where('TYPE', '=', 'P')
        ->where('CATEGORY', '=', '0')
        ->get();

        foreach ($listOfSP as $SP) {

            $listOfSPScript = DB::connection('sqlsrv')
            ->table('sys.schemas')
            ->addselect('sys.sql_modules.definition')
            ->Join('sys.procedures', 'sys.schemas.schema_id', '=', 'sys.procedures.schema_id')
            ->Join('sys.sql_modules', 'sys.procedures.object_id', '=', 'sys.sql_modules.object_id')
            ->where('sys.procedures.NAME', '=', $SP->NAME)
            ->get();

            // $responseArray1 = @json_decode(json_encode($listOfSPScript ), true);

            // return $responseArray1;

            $selectCount= 0;
            $insertCount= 0;
            $createCount= 0;
            $updateCount= 0;
            $execCount= 0;
            $printCount= 0;
            $deleteCount= 0;
    
            $word1 = "SELECT";
            $word2 = "INSERT";
            $word3 = "CREATE";
            $word4 = "DELETE";
            $word5 = "UPDATE";
            $word6 = "EXEC";
            $word7 = "PRINT";

            if(stripos($listOfSPScript, $word1) !== false){
                $selectCount = $selectCount +1;
            } 
            if (stripos($listOfSPScript, $word2) !== false){
                $insertCount = $insertCount + 1;
            } 
            if (stripos($listOfSPScript, $word3)!== false){
                $createCount = $createCount + 1;
            } 
            if (stripos($listOfSPScript, $word4)!== false){
                $deleteCount = $deleteCount + 1;
            }
            if (stripos($listOfSPScript, $word5)!== false){
                $updateCount = $updateCount + 1;
            }
            if (stripos($listOfSPScript, $word6)!== false){
                $execCount = $execCount + 1;
            }
            if (stripos($listOfSPScript, $word7)!== false){
                $printCount = $printCount + 1;
            }
            
    
            $listOfSPParams = DB::connection('sqlsrv')
            ->table('sys.objects')
    
            ->addselect('sys.parameters.name')
            ->selectraw('TYPE_NAME(sys.parameters.user_type_id)  as type')
            // ->addselect('sys.parameters.max_length')
            ->Join('sys.parameters', 'sys.objects.OBJECT_ID', '=', 'sys.parameters.OBJECT_ID')
            ->where('sys.objects.name', '=', $SP->NAME)
            ->get();

            // $returnData['data']['store procedure name'] = strtolower('SP_ResortDocToDoItemConditionSorter');
			// $returnData['data']['number of parameters'] = '1';
			// $returnData['data']['parameters'] = json_decode('[{"name":"@DocToDoItemID","type":"int","max_length":"4"}]');
			// return $returnData;
    

            $controllerFile = fopen("ModelsAndControllers/CreatedControllers/" . $SP->NAME . "Controller.php", "w") or die("Unable to open file!");

            $controllerFileContent = "<?php\n";
            $controllerFileContent .= "\n";
            $controllerFileContent .= "namespace App\Http\Controllers\StoredProcedureControllers;\n";
            $controllerFileContent .= "\n";
            $controllerFileContent .= "use App\Http\Controllers\Controller;\n";
            $controllerFileContent .= "use App\Custom\ControllerHelper;\n";
            $controllerFileContent .= "use DB;\n";
            $controllerFileContent .= "use Illuminate\Http\Request;\n";
            $controllerFileContent .= "\n";
            $controllerFileContent .= "class " . $SP->NAME . "Controller extends Controller\n";
            $controllerFileContent .= "{\n";
            // $controllerFileContent .= "\n";
            // $controllerFileContent .= "\n//select =".$selectCount;
            // $controllerFileContent .= "\n//insert =".$insertCount;
            // $controllerFileContent .= "\n//update =".$updateCount;
            // $controllerFileContent .= "\n//create =".$createCount;
            // $controllerFileContent .= "\n//exec =".$execCount;
            // $controllerFileContent .= "\n//print =".$printCount;
            // $controllerFileContent .= "\n//delete =".$deleteCount;
            $controllerFileContent .= "\n";
            // $controllerFileContent .= "\n".$SP->definition;
            $controllerFileContent .= "\n";
            
            $controllerFileContent .= "\tpublic function parameters(Request \$request)\n";
            $controllerFileContent .= "\t{\n";
            $controllerFileContent .= "\t\treturn ControllerHelper::tryCatch(\$request, function (\$request) {\n";
            $controllerFileContent .= "\t\t\n";
            if (count($listOfSPParams)>0){
                
                $controllerFileContent .= "\t\t\t\$returnData['data']['store producure name'] = strtolower('$SP->NAME');\n";
                $controllerFileContent .= "\t\t\t\$returnData['data']['number of parameters'] = '" .(string) count($listOfSPParams)."';\n";
                
                $controllerFileContent .= "\t\t\t\$returnData['data']['parameters'] = json_decode('".json_encode($listOfSPParams)."');\n";
                $controllerFileContent .= "\t\t\treturn \$returnData;\n";

            }else { 

                
                $controllerFileContent .="\t\t\t\$returnData['data'] = 'Requires no Parameters';\n";
                $controllerFileContent .= "\t\treturn \$returnData;\n";
                
            }
            $controllerFileContent .= "\t\t\n";
            $controllerFileContent .= "\t\t});\n";
            $controllerFileContent .= "\n";
            $controllerFileContent .= "\t}\n";
            $controllerFileContent .= "\n";

            $controllerFileContent .= "\tpublic function execute(Request \$request)\n";
            $controllerFileContent .= "\t{\n";
            $controllerFileContent .= "\t\treturn ControllerHelper::tryCatch(\$request, function (\$request) {\n";
            $controllerFileContent .= "\t\t\n";
            $controllerFileContent .= "\t\t\t\$responseObject = DB::connection('sqlsrv')->";

            if ($deleteCount > 0){
                $controllerFileContent .= "statement";
            } else
            if ($insertCount > 0){
                $controllerFileContent .= "statement";
            } else 
            if ($createCount > 1){
                $controllerFileContent .= "statement";
            } else
            if ($updateCount > 0){
                $controllerFileContent .= "statement";
            } else 
            if ($execCount > 0){
                $controllerFileContent .= "statement";
            } else 
            if ($selectCount > 0){
                $controllerFileContent .= "select";
            } else 
            if ($printCount > 0){
                $controllerFileContent .= "select";
            } else {
                $controllerFileContent .= "##PROBLEM";
            }
            
            
            $controllerFileContent .= "('EXEC ".$SP->NAME;

            if (count($listOfSPParams) == 1){
                $controllerFileContent .= "\t";
                foreach($listOfSPParams as $params){

                    $controllerFileContent .= strtolower($params->name)."='.\$request->".strtolower( ltrim($params->name, '@')).");\n";
                }
            }
            if (count($listOfSPParams) > 1){
                $controllerFileContent .= "\t";
                $loopString = "";
                foreach($listOfSPParams as $params){

                    $loopString .= strtolower($params->name)."=\"'.\$request->".strtolower( ltrim($params->name, '@')).".'\",";
                }
                $trimmed = rtrim($loopString, ",");
                // return $trimmed;
                $controllerFileContent .= $trimmed."');";
            }

            if (count($listOfSPParams) == 0 ){
                $controllerFileContent .= "');";
            }
        

            $controllerFileContent .= "\n";
            $controllerFileContent .= "\t\t\treturn ControllerHelper::StoredProcedureFormatHelper(\$responseObject, \$request);";
            // $controllerFileContent .= "\t\t\t\$responseArray = @json_decode(json_encode(\$responseObject ), true);\n";
			// $controllerFileContent .= "\t\t\t\$returnData[\"data\"] = \$responseArray;\n";
            // $controllerFileContent .= "\t\t\treturn \$returnData;\n";
            $controllerFileContent .= "\t\t\n";

            $controllerFileContent .= "\t\t});\n";
            $controllerFileContent .= "\n";
            $controllerFileContent .= "\t}\n";
            $controllerFileContent .= "\n";
            
            $controllerFileContent .= "} \n";
            $controllerFileContent .= "\n";

            fwrite($controllerFile, $controllerFileContent);
            fclose($controllerFile);
        }

    }

}