<?php

namespace App\Http\Controllers;

use App\Models\Urn;
use App\Mail\Refund;
use App\Models\Niche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersHistoryController extends Controller
{
    public function cancelNiche($id)
    {
        $niche = Niche::where('niche_id',$id)->first();
        if($niche->status == 'Occupied')
        {
            $data = [
                'name'=>Auth::user()->firstname.' '.Auth::user()->lastname
            ];
            Mail::to(Auth::user()->email)->send(new Refund($data));
            Mail::to('onlinecolumbariumsystem@gmail.com')->send(new Refund($data));
            $niche->update([
                'status'=>'Available',
                'paymentmethod'=>null,
                'paymenttype'=>null,
                'ref'=>null,
                'downpayment'=>null,
                'monthly'=>null,
                'date'=>null,
                'user_id'=>null,
            ]);
        }else{
            $niche->update([
                'status'=>'Available',
                'paymentmethod'=>null,
                'paymenttype'=>null,
                'ref'=>null,
                'downpayment'=>null,
                'monthly'=>null,
                'date'=>null,
                'user_id'=>null,
            ]);
        }

        return back();
    }
    public function myNiches()
    {
        $niche = Niche::join('buildings', 'niches.building_id', 'buildings.building_id')
            ->select('niches.*','buildings.name')
            ->where('user_id',auth()->id())
            ->where(function ($query) {
                $query->where('niches.status', 'Occupied')
                    ->orWhere('niches.status', 'Pending');
            })
            ->get();

        return response()->json($niche);
    }

    public function myUrns()
    {
        $niche = Urn::join('niches','niches.niche_id','urns.niche_id')
            ->join('buildings', 'niches.building_id', 'buildings.building_id')
            ->select('urns.*','niches.niche_number','buildings.name as bname')
            ->where('user_id',1)
            ->where(function ($query) {
                $query->where('niches.status', 'Occupied')
                    ->orWhere('niches.status', 'Pending');
            })
            ->get();

        return response()->json($niche);
    }

    public function editMyUrn($id)
    {
        $urn = Urn::findOrFail($id);
        return response()->json($urn);
    }

    public function updateMyUrn(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'deceasedName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Failed to update. ',500]);
        }

        try {
            $urn = Urn::findOrFail($id);
            $urn->message = $request->message;
            $urn->name = $request->deceasedName;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '-' . $file->getClientOriginalName();
                $urn->deceased_image = $imageName;
                Storage::put($imageName, file_get_contents($file));
            }

            $urn->save();

            return response()->json(["success"=>true,"data"=>$urn]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to update. ' . $e->getMessage()], 500);
        }
    }
}
