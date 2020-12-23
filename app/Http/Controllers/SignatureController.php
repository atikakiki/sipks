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

class SignatureController extends Controller
{
    public function trainSignature()
    {	
    	$id_usr = Auth::user()->id;
    	$image_name = 'uploadSignature/'.$id_usr;

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
    	$command = escapeshellcmd("python ".public_path("code/doTrainSignature.py")." ".$id_usr);
        $output = shell_exec($command);
    	$m = array('msg' => $output);
    	echo json_encode($m);
    }

    public function sendSignature(Request $request)
    {    	
    	$base64_string = $request->file('image');

    	$id_usr = Auth::user()->id;
    	$image_name = 'uploadSignature/'.$id_usr;

    	if (!file_exists($image_name)) {
    	 if (!mkdir($image_name)) {
    	    $m=array('msg' => "REJECTED, cant create folder");
    	    echo json_encode($m);
    	    return;}
    	}

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi)+1;
    	$files = File::files(public_path($image_name));
    	  $filecount = 0;
    	  
    	  if ($files !== false) {
    	      $filecount = count($files)+1;
    	  } 

    	// $data = explode(',', $base64_string);
    	$fullName = $id_usr."_".$filecount."_". date("YmdHis") .".png";
    	// $ifp = fopen(public_path("uploadSignature/".$id_usr), "wb");
    	// fwrite($ifp, base64_decode($data[1]));
    	// fclose($ifp);
    	$ifp = $base64_string->move($image_name,$fullName);
    	if (!$ifp){
    	    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    	    echo json_encode($m);
    	    return;}

    	$command = escapeshellcmd("python ".public_path("code/checkSignature.py")." ". public_path("uploadSignature/".$id_usr."/".$fullName));
    	$output = shell_exec($command);
        // echo json_encode($output);

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi);

    	$m = array('msg' => $output);
    	echo json_encode($m);

    }

    public function predictSignature(Request $request)
    {
    	$base64_string = $request->file('image');

    	$id_usr = Auth::user()->id;
    	$image_name = 'predictSignature/'.$id_usr;

    	if (!file_exists($image_name)) {
    	 if (!mkdir($image_name)) {
    	    $m=array('msg' => "REJECTED, cant create folder");
    	    echo json_encode($m);
    	    return;}
    	}

    	// $fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
    	// $fileCount = iterator_count($fi)+1;
    	// $data = explode(',', $base64_string);
    	// $fullName = $image_name."/X__".$fileCount."_". date("YmdHis") .".png";
    	// $ifp = fopen($fullName, "wb");
    	// fwrite($ifp, base64_decode($data[1]));
    	// fclose($ifp);
    	$files = File::files(public_path($image_name));
    	  $filecount = 0;
    	  
    	  if ($files !== false) {
    	      $filecount = count($files)+1;
    	  } 


    	$fullName = $id_usr."_".$filecount."_". date("YmdHis") .".png";

    	$ifp = $base64_string->move($image_name,$fullName);

    	if (!$ifp){
    	    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    	    echo json_encode($m);
    	    return;}

        $command = escapeshellcmd("python ".public_path("code/doPredictSignature.py")." ".$id_usr." ". public_path("uploadSignature/".$id_usr."/".$fullName));
        $output = shell_exec($command);
    	// $command = escapeshellcmd("python doPredictSignature.py ".$username ." " .$fullName);
    	// $output = shell_exec($command);

    	$m = array('msg' => $output);
    	echo json_encode($m);
    }
}
