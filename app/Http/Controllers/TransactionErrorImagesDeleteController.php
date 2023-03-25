<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionErrorImagesDeleteController extends Controller
{
    public function imageDelete(Request $request)
    {
        if( $request->product_id ) {
            $image_path = public_path('storage').'/images/products';
            $files = glob($image_path.'/*');
            $delete = [];

            sleep(10);

            foreach ( $files as $key => $file ) {

                $start = strripos($file, '/');
                $end = (strpos($file, '_') - 1);
                $count = (int)$end - (int)$start;
                $delete_count = ( strpos($file, '_') - $count );
                $result = substr($file, ($start = strripos($file, '/') + 1), $count );

                if( $result === $request->product_id ) {
                    $delete[$key] = substr($file, ($start = strripos($file, '/') + 1 ) );

                    unlink( $file );

//                    response()->json([
//                        'delete_file' => $delete
//                    ]);
                }
            }

            return response()->json([
                'delete_file' => $delete
            ]);
        }
        else {
            return response()->json([
                'response' => $request
            ]);
        }
    }
}
