<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;

class PriceController extends Controller
{
    public function show(Price $price)
    {
        return $price;
    }

    public function importPrices(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xlsx,xls'],
            'type' => ['required', 'integer'], // Auto, motos, etc.
        ]);

        Log::info('importPrices - Request method: ' . $request->getMethod());
        Log::info('importPrices - Request URL: ' . $request->fullUrl());
        Log::info('importPrices - Request headers: ' . json_encode($request->headers->all()));
        
        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file);
        } catch (\Exception $e) {
            Log::error('importPrices - Error al cargar el archivo Excel: ' . $e->getMessage());
            return back()->with('error', 'Error al cargar el archivo Excel: ' . $e->getMessage());
        }

        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();


        foreach ($rows as $key => $row) {
            if ($key == 0 || empty($row[0])) continue;
    
            try {
                $price = Price::where('marca', $row[3])->where('modelo', $row[4])->where('version', $row[5])->first();
    
                if ($price) {
                    Price::where('id', $price->id)->update([
                        'MONEDA' => $row[6],
                        '0km' => !empty($row[7]) ? $row[7] : 0,
                        '2023' => !empty($row[8]) ? $row[8] : 0,
                        '2022' => !empty($row[9]) ? $row[9] : 0,
                        '2021' => !empty($row[10]) ? $row[10] : 0,
                        '2020' => !empty($row[11]) ? $row[11] : 0,
                        '2019' => !empty($row[12]) ? $row[12] : 0,
                        '2018' => !empty($row[13]) ? $row[13] : 0,
                        '2017' => !empty($row[14]) ? $row[14] : 0,
                        '2016' => !empty($row[15]) ? $row[15] : 0,
                        '2015' => !empty($row[16]) ? $row[16] : 0,
                        '2014' => !empty($row[17]) ? $row[17] : 0,
                        '2013' => !empty($row[18]) ? $row[18] : 0,
                        '2012' => !empty($row[19]) ? $row[19] : 0,
                        '2011' => !empty($row[20]) ? $row[20] : 0,
                        '2010' => !empty($row[21]) ? $row[21] : 0,
                        '2009' => !empty($row[22]) ? $row[22] : 0,
                        '2008' => !empty($row[23]) ? $row[23] : 0,
                        '2007' => !empty($row[24]) ? $row[24] : 0,
                        '2006' => !empty($row[25]) ? $row[25] : 0,
                        '2005' => !empty($row[26]) ? $row[26] : 0,
                        '2004' => !empty($row[27]) ? $row[27] : 0,
                        '2003' => !empty($row[28]) ? $row[28] : 0,
                        '2002' => !empty($row[29]) ? $row[29] : 0,
                        '2001' => !empty($row[30]) ? $row[30] : 0,
                        '2000' => !empty($row[31]) ? $row[31] : 0,
                        '1999' => !empty($row[32]) ? $row[32] : 0,
                        '1998' => !empty($row[33]) ? $row[33] : 0,
                        '1997' => !empty($row[34]) ? $row[34] : 0,
                        '1996' => !empty($row[35]) ? $row[35] : 0,
                        '1995' => !empty($row[36]) ? $row[36] : 0,
                    ]);
                } else {
                    Price::create([
                        'MARCA' => $row[3],
                        'MODELO' => $row[4],
                        'VERSION' => $row[5],
                        'ID_TIPO' => $request->type,
                        'MONEDA' => $row[6],
                        '0km' => !empty($row[7]) ? $row[7] : 0,
                        '2023' => !empty($row[8]) ? $row[8] : 0,
                        '2022' => !empty($row[9]) ? $row[9] : 0,
                        '2021' => !empty($row[10]) ? $row[10] : 0,
                        '2020' => !empty($row[11]) ? $row[11] : 0,
                        '2019' => !empty($row[12]) ? $row[12] : 0,
                        '2018' => !empty($row[13]) ? $row[13] : 0,
                        '2017' => !empty($row[14]) ? $row[14] : 0,
                        '2016' => !empty($row[15]) ? $row[15] : 0,
                        '2015' => !empty($row[16]) ? $row[16] : 0,
                        '2014' => !empty($row[17]) ? $row[17] : 0,
                        '2013' => !empty($row[18]) ? $row[18] : 0,
                        '2012' => !empty($row[19]) ? $row[19] : 0,
                        '2011' => !empty($row[20]) ? $row[20] : 0,
                        '2010' => !empty($row[21]) ? $row[21] : 0,
                        '2009' => !empty($row[22]) ? $row[22] : 0,
                        '2008' => !empty($row[23]) ? $row[23] : 0,
                        '2007' => !empty($row[24]) ? $row[24] : 0,
                        '2006' => !empty($row[25]) ? $row[25] : 0,
                        '2005' => !empty($row[26]) ? $row[26] : 0,
                        '2004' => !empty($row[27]) ? $row[27] : 0,
                        '2003' => !empty($row[28]) ? $row[28] : 0,
                        '2002' => !empty($row[29]) ? $row[29] : 0,
                        '2001' => !empty($row[30]) ? $row[30] : 0,
                        '2000' => !empty($row[31]) ? $row[31] : 0,
                        '1999' => !empty($row[32]) ? $row[32] : 0,
                        '1998' => !empty($row[33]) ? $row[33] : 0,
                        '1997' => !empty($row[34]) ? $row[34] : 0,
                        '1996' => !empty($row[35]) ? $row[35] : 0,
                        '1995' => !empty($row[36]) ? $row[36] : 0,
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('importPrices - Error al procesar fila ' . $key . ': ' . $e->getMessage());
                return back()->with('error', 'Error al procesar fila ' . $key . ': ' . $e->getMessage());
            }
        }
        Log::info('importPrices - Datos del archivo Excel importados correctamente.');
      return response()->json(['success' => 'Datos del archivo Excel importados correctamente.']);
    }


    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
          //  $price = Price::paginate($perPage);
          
          $prices = Price::select('id', 'id_tipo', 'marca', 'modelo', 'version', 'moneda', '0km', 
          '2023 as 2023', '2022 as year_2022', '2021 as year_2021', 
          '2020 as year_2020', '2019 as year_2019', '2018 as year_2018', 
          '2017 as year_2017', '2016 as year_2016', '2015 as year_2015', 
          '2014 as year_2014', '2013 as year_2013', '2012 as year_2012', 
          '2011 as year_2011', '2010 as year_2010', '2009 as year_2009', 
          '2008 as year_2008', '2007 as year_2007', '2006 as year_2006', 
          '2005 as year_2005', '2004 as year_2004', '2003 as year_2003', 
          '2002 as year_2002', '2001 as year_2001', '2000 as year_2000', 
          '1999 as year_1999', '1998 as year_1998', '1997 as year_1997', 
          '1996 as year_1996', '1995 as year_1995')
            ->paginate($perPage);


            return response()->json([
                'success' => true,
                'message' => 'Prices retrieved successfully',
                'data' => $prices,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error retrieving prices: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve prices',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
