public function crud(Request $request,$id=null){

        $data = $request->all();
        
        function loopValues($arrayValues){
            $arraynama = '';
            $array = array_values($arrayValues);
        
            for($x=3 ;$x < count($array); $x++){
                $arraynama .= $array[$x] . ',';    
            }
            return rtrim($arraynama, ",");
        }

        function loopFileds($arrayFileds){
            $arraynamafileds = '';
            $arraycount = array_values($arrayFileds);
            $array2 = array_keys($arrayFileds);
            for($x=3 ; $x < count($arraycount); $x++){
                $arraynamafileds .= $array2[$x] . ',';    
            }
            return rtrim($arraynamafileds, ",");
        }
        function Valuesloop($arrayFileds){
            $Valuesloop = '';
            $arraycount = array_values($arrayFileds);
            for($x=3 ; $x < count($arraycount); $x++){
                $Valuesloop .= '?' . ',';    
            }
            return rtrim($Valuesloop, ",");
        }

        function updateQuery($data2){
            $updateArray = '';
            $arraycount = array_values($data2);
            $array2 = array_keys($data2);
            for($x=3 ; $x < count($arraycount); $x++){
                $updateArray .= $array2[$x] . " = '".$arraycount[$x]."',";    
            }
            return rtrim($updateArray, ",");
        }
        $values = Valuesloop($data);
        $fileds = loopFileds($data);
        $valuesdata = loopValues($data);
        $final = explode(',',$valuesdata);
        $updateQuery = updateQuery($data);

       if($request->action == 'save'){
        $status = DB::insert('insert into '.$request->table. '('.$fileds.') values('.$values.')',$final);
        if($status){
            echo 'Inserted';
        }
       }
       if($request->action == 'update'){
        // echo 'UPDATE '.$request->table.' SET '. $updateQuery .' WHERE id = '.$id;
        $status = DB::statement('UPDATE '.$request->table.' SET '. $updateQuery .' WHERE id = '.$id);
        if($status){
            echo 'Updated';
        }
       }
       if($request->action == 'delete'){
        $status = DB::statement('DELETE FROM '.$request->table. ' WHERE `id` = '.$id);
        if($status){
            echo 'Deleted';
        }
       }
    }