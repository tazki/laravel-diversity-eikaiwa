<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    /**
    * @OA\Post(
    *   path="/api/user/{id}/update",
    *   tags={"User"},
    *   description="{id} is the User ID from users table",
    *   summary="Update",
    *   operationId="update",
    *   security={{ "Bearer": {} }},
    *
    *  @OA\Parameter(
    *      name="first_name",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="last_name",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="mobile_number",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="phone_number",
    *      in="query",
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="date_of_birth",
    *      in="query",
    *      @OA\Schema(
    *           type="date"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="gender",
    *      in="query",
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="address",
    *      in="query",
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="about_you",
    *      in="query",
    *      @OA\Schema(
    *           type="text"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="fields_of_interest",
    *      description="Array of Interest and use json_encode",
    *      in="query",
    *      @OA\Schema(
    *           type="json"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="skills",
    *      description="Array of Skills and use json_encode",
    *      in="query",
    *      @OA\Schema(
    *           type="json"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="language",
    *      description="Array of Language and use json_encode",
    *      in="query",
    *      @OA\Schema(
    *           type="json"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="qualification",
    *      description="Array of Qualification and use json_encode",
    *      in="query",
    *      @OA\Schema(
    *           type="json"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="other",
    *      in="query",
    *      @OA\Schema(
    *           type="text"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="avatar",
    *      description="this should be image upload",
    *      in="query",
    *      @OA\Schema(
    *           type="image"
    *      )
    *   ),
    *   @OA\Response(
    *     response=200,
    *     description="Success"
    *  )
    *)
    **/
    public function update($id)
    {
        $cleanData = request()->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users','email')->ignore($id),
            ],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'date_of_birth' => ['date'],
            'gender' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'about_you' => ['string', 'max:255'],
            'fields_of_interest' => ['json'],
            'skills' => ['json'],
            'language' => ['json'],
            'qualification' => ['json'],
            'other' => ['string', 'max:255'],
            'avatar' => 'mimes:jpg,bmp,png'
        ]);

        if (request()->hasFile('avatar') && !empty(request()->file('avatar'))) {
            $oldFile = User::find($id)->avatar;
            $cleanData['avatar'] = fileUpload('avatar', $oldFile, $id);
        }

        if(User::findOrFail($id)->update($cleanData)) {
            $row = User::findOrFail($id);
            if(!empty($row->avatar)) {
                $row->avatar = userFile($row->avatar, '', $id);
            }

            return response()->json([
                'success' => true,
                'data' => $row
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User can not be updated'
            ], 500);
        }
    }

    // public function changePassword(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $validator = Validator::make($request->all(),
    //             [
    //                 'current_password' => 'required',
    //                 'new_password' => 'required|min:8|confirmed|different:current_password'
    //             ]
    //         );

    //         if($validator->fails()) {
    //             return response()->json([
    //                 'notify' => 'inline',
    //                 'status' => 'danger',
    //                 'message' => $validator->errors()->all()
    //             ]);
    //         }

    //         $member = Member::findOrFail(self::userdata()->id);
    //         if (Hash::check($request->current_password, $member->password)) { 
    //             $member->fill([
    //                 'password' => Hash::make($request->new_password)
    //             ])->save();

    //             $msg = array(
    //                 'notify' => 'inline',
    //                 'status'  => 'success',
    //                 'message' => 'Password changed',
    //                 'action' => 'hideModal'
    //             );
    //             return response()->json($msg);
    //         } else {
    //             $msg = array(
    //                 'notify' => 'inline',
    //                 'status'  => 'danger',
    //                 'message' => 'Current Password do not match'
    //             );
    //             return response()->json($msg);
    //         }
    //     }
    // }
}