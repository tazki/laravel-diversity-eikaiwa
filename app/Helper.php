<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Hashids\Hashids;
use App\Models\UserPayments;
use App\Models\UserBookings;

if(!function_exists('studentActivePoints')) {
    function studentActivePoints($id = '') {
        if(empty($id)) {
            $id = Auth::user()->id;
        }
        $rowCompletedPayment = UserPayments::where([
                ['user_id', '=', $id],
                ['status', '=', 2]
            ])
            ->orderBy('updated_at', 'desc')
            ->get();
        $totalPoints = 0;
        if(is_object($rowCompletedPayment)) {
            foreach($rowCompletedPayment as $item) {
                $totalPoints += $item->service_points;
            }
        }

        $rowCompletedClass = UserBookings::where('student_id', '=', $id)
            ->whereIN('status', array(1,2,3))
            ->count();

        // echo 'activePoints:'.$activePoints.' totalPoints:'.$totalPoints.' rowCompletedClass:'.$rowCompletedClass;
        // die;
        return $totalPoints - $rowCompletedClass;
    }
}

function currentService($service_id) {
    switch($service_id) {
        case 4:
            $rows['payment']['price'] = 5799;
            $rows['payment']['price_label'] = '¥5,799';
            $rows['payment']['points'] = 4;
            $rows['payment']['service'] = __('Special Plan');
        break;
        case 3:
            $rows['payment']['price'] = 13310;
            $rows['payment']['price_label'] = '¥13,310';
            $rows['payment']['points'] = 8;
            $rows['payment']['service'] = __('Plan B');
        break;
        case 2:
            $rows['payment']['price'] = 7480;
            $rows['payment']['price_label'] = '¥7,480';
            $rows['payment']['points'] = 4;
            $rows['payment']['service'] = __('Plan A');
        break;
        default:
            $rows['payment']['price'] = 0;
            $rows['payment']['price_label'] = '¥0';
            $rows['payment']['points'] = 1;
            $rows['payment']['service'] = __('Trial');
        break;
    }

    return $rows;
}


if(!function_exists('countryData')) {
    function countryData() {
        $country = array();
        $rows = \DB::table('countrys')
        ->where('country_status', '=', 1)
        ->orderBy('country_name', 'asc')
        ->get();
        foreach($rows as $key => $val) {
            $country[$val->id] = $val;
        }

        return $country;
    }
}

if(!function_exists('pr')) {
    function pr($array) {
      if(is_array($array) || is_object($array)) {
          echo'<pre><div style="border:1px solid #990000; padding:20px; margin:10px;">';
          print_r($array);
          echo'</div></pre>';
      } else {
          echo $array.' is not an array!';
      }
    }
}

if(!function_exists('fileUpload')) {
    function fileUpload($fileName, $oldFileName, $userId) {
        // This will delete old image if has
        if(!empty($oldFileName)) {
            $oldFile = userFile($oldFileName, 'serverfilename', $userId);
            Storage::disk('public')->delete('user-'.$userId.'/'.$oldFile);
        }

        $cover = request()->file($fileName);
        $newUniqueFilename = date('Ymdhis').rand(0,999).'.'.$cover->getClientOriginalExtension();
        Storage::disk('public')->put('user-'.$userId.'/'.$newUniqueFilename,  File::get($cover));
        return $newUniqueFilename.fileDivider().$cover->getClientOriginalName();
    }
}

if(!function_exists('userFile')) {
	function userFile($file, $return='', $userId) {
        $subfolder = '';
        if(isset($userId)) {
            $subfolder = 'user-'.$userId;
        }
		
		if(!empty($file) && !empty($subfolder)) {
			$row = explode(fileDivider(), $file);
			if($return=='filename') {
				return $row[1];
			} elseif($return=='serverfilename') {
                return $row[0];
            } elseif($return=='serverfileextension') {
                $fileArr = explode('.', $row[0]);
                if(is_array($fileArr)) {
                    return strtolower(end($fileArr));
                }
            } elseif($return=='filepath_and_filename') {
                return Storage::disk('public')->path($subfolder.'/'.$row[0]);
			} else {
                return secure_asset('uploads/'.$subfolder.'/'.$row[0]);
			}
		}
	}
}

if(!function_exists('fileDivider')) {
	function fileDivider() {
		return '._.._.';
	}
}

if(!function_exists('fileIcon')) {
	function fileIcon($file, $organizationId='') {

        $fileExtension = userFile($file, 'serverfileextension', $organizationId);
        if(in_array($fileExtension, array('jpg', 'jpeg', 'png'))) {
            return '<i class="far fa-image"></i>';
        } elseif(in_array($fileExtension, array('doc', 'docx'))) {
            return '<i class="far fa-file-word"></i>';
        } elseif(in_array($fileExtension, array('xls', 'xlsx', 'csv'))) {
            return '<i class="far fa-file-excel"></i> ';
        } elseif(in_array($fileExtension, array('pptx'))) {
            return '<i class="far fa-file-powerpoint"></i>';
        } elseif(in_array($fileExtension, array('txt'))) {
            return '<i class="far fa-file-alt"></i>';
        } elseif($fileExtension=='pdf') {
            return '<i class="far fa-file-pdf"></i>';
        }
    }
}

if (! function_exists('timeElapsedString'))
{
	function timeElapsedString($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

if(!function_exists('base64UrlEncode')) {
    function base64UrlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if(!function_exists('base64UrlDecode')) {
    function base64UrlDecode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}

if(!function_exists('encodeId')) {
    function encodeId($id) {
        $hashids = new Hashids('matome', 30); // pad to length 30
        return $hashids->encode($id);
    }
}

if(!function_exists('decodeId')) {
    function decodeId($id) {
        $hashids = new Hashids('matome', 30); // pad to length 30
        return (isset($hashids->decode($id)[0])) ? $hashids->decode($id)[0] : 0;
    }
}