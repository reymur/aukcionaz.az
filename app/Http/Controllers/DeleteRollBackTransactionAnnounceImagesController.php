<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteRollBackTransactionAnnounceImagesController extends Controller
{
    public function imageDelete(Request $request)
    {
        if( $request->product_id ) {

            $image_path = public_path('storage').'/images/products';
            $files = glob($image_path.'/*');

            sleep(10);

            foreach ( $files as $key => $file ) {

                $start = strripos($file, '/');
                $end = (strpos($file, '_') - 1);
                $count = (int)$end - (int)$start;
                $delete_count = ( strpos($file, '_') - $count );
                $result = substr($file, ($start = strripos($file, '/') + 1), $count );

                if( $result === $request->product_id ) {
                    unlink( $file );
                }
            }
        }
    }
}
