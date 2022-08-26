<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function crud(Request $request, $id = null)
    {
        $data = $request->all();

        $data2 =  $request->file();

        $r = array_pop($data2[0]->originalName);

        dd($r);

        function images($data2, $request){

            $data2 = array_shift(array_values($data2));

            for($x=0; $x < count($data2); $x++){
                $img = $request->file($data2[$x]);
                $imageName ='image-' .(strtotime(now()) . rand(111, 99)) .'.' .$img->getClientOriginalExtension();
                $request->file($data2[$x])->move(public_path() . '/assets/images/', $imageName);
                $data[$data2[$x]] = $imageName;
            }
            return true;
        }
            
        $result=images($data2,$request);
        dd($result);

        function loopValues($arrayValues){
            $arraynama = '';
            $array = array_values($arrayValues);
        
            for($x=3 ;$x < count($array); $x++){
                $arraynama .= $array[$x] . ',';    
            }
            return rtrim($arraynama, ",");
        }

        function loopFileds($arrayFileds)
        {
            $arraynamafileds = '';
            $arraycount = array_values($arrayFileds);
            $array2 = array_keys($arrayFileds);
            for ($x = 3; $x < count($arraycount); $x++) {
                $arraynamafileds .= $array2[$x] . ',';
            }
            return rtrim($arraynamafileds, ',');
        }
        function Valuesloop($arrayFileds)
        {
            $Valuesloop = '';
            $arraycount = array_values($arrayFileds);
            for ($x = 3; $x < count($arraycount); $x++) {
                $Valuesloop .= '?' . ',';
            }
            return rtrim($Valuesloop, ',');
        }

        function updateQuery($data2)
        {
            $updateArray = '';
            $arraycount = array_values($data2);
            $array2 = array_keys($data2);
            for ($x = 3; $x < count($arraycount); $x++) {
                $updateArray .= $array2[$x] . " = '" . $arraycount[$x] . "',";
            }
            return rtrim($updateArray, ',');
        }

        $values = Valuesloop($data);
        $fileds = loopFileds($data);
        $valuesdata = loopValues($data, $request);
        $final = explode(',', $valuesdata);
        $updateQuery = updateQuery($data);

        if ($request->action == 'save') {
            echo 'insert into ' .
            $request->table .
            '(' .
            $fileds .
            ') values(' .
            $values .
            ')',
                $final;
        }
        if ($request->action == 'update') {
            $status = DB::statement(
                'UPDATE ' .
                    $request->table .
                    ' SET ' .
                    $updateQuery .
                    ' WHERE id = ' .
                    $id
            );
            if ($status) {
                echo 'Updated';
            }
        }
        if ($request->action == 'delete') {
            $status = DB::statement(
                'DELETE FROM ' . $request->table . ' WHERE `id` = ' . $id
            );
            if ($status) {
                echo 'Deleted';
            }
        }
    }
}