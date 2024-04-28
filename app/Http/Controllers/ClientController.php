<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\CsvService;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    protected $csvService;
    protected $csvFileName = "clients.csv";

    public function __construct(CsvService $csvService)
    {
        $this->csvService =$csvService;
    }
    public function  index (){
        $clients = $this->csvService->fetchDataFromCsv($this->csvFileName);
        if(empty($clients)){
           
        return response()->json([
            "message"=>"No Client Yet"
        ]); 
      
    }
    $paginationData = paginate($clients,2);
    return response()->json(['clients' => $paginationData['data'], 'pagination' => $paginationData['paginationData']]);
    }

    public function store(ClientRequest $request){
        $data = $request->validated();
        try { 
           $this->csvService->saveDataToCsv($request->all(),$this->csvFileName);
            $message ="client is created successfully";
            applicationLog()->info($message);
         
        } catch (\Throwable $th) {
            $message ="Something Wrong";
            applicationLog()->error($message);
        }
        return  response()->json([
            'message'=> $message
        ]);
    }

    public function show($row){
        $client = $this->csvService->readSignleRowOfCSV($this->csvFileName,$row);
        return response()->json([
            'clientDetails'=> $client
        ]
        );
    }
}
