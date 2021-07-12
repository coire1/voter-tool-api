<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PickList;
use App\Models\Rationale;
use Illuminate\Support\Facades\Hash;

class PickListController extends Controller
{

    private function storeRationales($challenges) {
      $data = [];
      if ($challenges) {
        foreach($challenges as $challenge) {
          $rationaleData = [
            'challenge_id' => $challenge['challenge_id']
          ];
          if (array_key_exists('proposals', $challenge)) {
            $rationaleData['proposals'] = $challenge['proposals'];
          }
          if (array_key_exists('downProposals', $challenge)) {
            $rationaleData['downProposals'] = $challenge['downProposals'];
          }
          if (array_key_exists('rationale', $challenge)) {
            $rationaleData['rationale'] = $challenge['rationale'];
          }
          $challengeData = new Rationale($rationaleData);
          array_push($data, $challengeData);
        }
      }
      return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'password' => 'required|string'
      ]);

      $pickList = PickList::create([
        'password' => Hash::make($request->password),
        'title' => $request->title
      ]);

      $challenges = $request->challenges;
      $pickList->rationales()->saveMany($this->storeRationales($challenges));

      return response()->json([
        'message' => 'Pick List saved',
        'pick_list' => ['uuid' => $pickList->uuid]
      ]);
    }

    public function update(Request $request, $id)
    {
      $pickList = PickList::where('uuid', $uuid)->first();
      if ($pickList) {
        if (Hash::check($request->password, $pickList->password)) {
          $pickList->update([
            'title' => $request->title
          ]);
          $pickList->rationales()->delete();
          $challenges = $request->challenges;
          $pickList->rationales()->saveMany($this->storeRationales($challenges));
          return response()->json([
            'message' => 'Pick List updated',
            'pick_list' => ['uuid' => $pickList->uuid]
          ]);
        } else {
          return response()->json([
            'message' => 'Password invalid'
          ], 501);
        }
      } else {
        return response()->json([
          'message' => 'Pick List not found'
        ], 404);
      }
    }

    public function show($uuid) {
      $pickList = PickList::where('uuid', $uuid)->with('rationales')->first();
      if ($pickList) {
        return response()->json([
          'pick_list' => $pickList
        ]);
      } else {
        return response()->json([
          'message' => 'Pick List not found'
        ], 404);
      }
    }
}
