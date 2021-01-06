<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//tambahan dari dinpen
use File;
use Intervention\Image\Facades\Image as Image;
use DB;
use Session;

class FaceController extends Controller
{
	//
	public function trainGAN(){
		$id_usr = Auth::user()->id;
    	$image_name = 'uploadFace/'.$id_usr;

    	if (!file_exists($image_name))
    	{
    	    $m = array('msg' => "REJECTED,no data to train");
    	    echo json_encode($m);
    	    return;
    	}

    	$files = File::files(public_path($image_name));
    	  $filecount = 0;
    	  
    	  if ($files !== false) {
    	      $filecount = count($files);
    	  }   	  

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi);
		// $command = escapeshellcmd("python ".public_path("code/gan.py")." ". public_path("uploadFace/".$id_usr."/".$fullName)." ".public_path("aligned_images/".$id_usr."/".$fullName));
		// $output = shell_exec($command);
		// if($output){
		// 	$m = array('msg' => "berhasil");
		// }
		// else{
		// 	$m = array('msg' => "gagal");
		// }
		// echo json_encode($m);
		$command = escapeshellcmd("python ".public_path("code/gan/run_model.py")." --input_path=". public_path("uploadFace/".$id_usr."")." --output_path=".public_path("uploadFace/".$id_usr.""));
        $output = shell_exec($command);
        $m = array('msg' => $output);
        echo json_encode($m);
	}

        public function trainFace()
    {	
    	$id_usr = Auth::user()->id;
    	$image_name = 'uploadFace/'.$id_usr;

    	if (!file_exists($image_name))
    	{
    	    $m = array('msg' => "REJECTED,no data to train");
    	    echo json_encode($m);
    	    return;
    	}

    	$files = File::files(public_path($image_name));
    	  $filecount = 0;
    	  
    	  if ($files !== false) {
    	      $filecount = count($files);
    	  }   	  

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi);
        $command = escapeshellcmd("python ".public_path("code/doTrainMobileNet.py")." ". $id_usr);
        $output = shell_exec($command);
        $m = array('msg' => $output);
        echo json_encode($m);
    }


        public function sendFace(Request $request)
    {    	
    	$base64_string = $request->file('image');

    	$id_usr = Auth::user()->id;
    	$image_name = 'uploadFace/'.$id_usr;

    	if (!file_exists($image_name)) {
    	 if (!mkdir($image_name)) {
    	    $m=array('msg' => "REJECTED, cant create folder");
    	    echo json_encode($m);
    	    return;}
    	}

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi)+1;
    	$files = File::files(public_path($image_name));
            // dd($files);

              // $filecount = 1;
              
        if ($files !== false) {
                  $filecount = count($files);
        } 



        if($filecount==5){
            echo json_encode(array('msg' => "Upload Wajah Selesai, Data Tersimpan"));
            return;
        }

    	$fullName = $id_usr."_".$filecount."_". date("YmdHis") .".png";
    	// $ifp = fopen($fullName, "wb");
    	// fwrite($ifp, base64_decode($data[1]));
    	// fclose($ifp);
    	$ifp = $base64_string->move($image_name,$fullName);
    	if (!$ifp){
    	    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    	    echo json_encode($m);
			return;
		}

		// $command = escapeshellcmd("python ".public_path("code/checkFace.py")." ". public_path("uploadFace/".$id_usr."/".$fullName));
		// $output = shell_exec($command);
    	// $command = escapeshellcmd("python checkSignature.py ".$fullName);
    	// $output = shell_exec($command);

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi);

    	$m = array('msg' => "Upload sebanyak 5x");
        echo json_encode($m);

    }

        public function predictFace(Request $request)
    {
    	$base64_string = $request->file('image');

    	$id_usr = Auth::user()->id;
    	$image_name = 'predictFace/'.$id_usr;

    	if (!file_exists($image_name)) {
    	 if (!mkdir($image_name)) {
    	    $m=array('msg' => "REJECTED, cant create folder");
    	    echo json_encode($m);
    	    return;}
    	}

   
    	$files = File::files(public_path($image_name));
    	  $filecount = 0;
    	  
    	  if ($files !== false) {
    	      $filecount = count($files)+1;
    	  } 


    	$fullName = $id_usr."_".$filecount."_". date("YmdHis") .".png";

        // dd($fullName);
    	$ifp = $base64_string->move($image_name,$fullName);

    	if (!$ifp){
    	    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    	    echo json_encode($m);
    	    return;}
        $command = escapeshellcmd("python ".public_path("code/doPredict.py")." ".$id_usr. " ".public_path("predictFace/".$id_usr."/".$fullName));
        $output = shell_exec($command);
    	$m = array('msg' => $output);
    	echo json_encode($m);
    }
}
