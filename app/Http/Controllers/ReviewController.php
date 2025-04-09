<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function leave_review(Request $request, string $carer)
    {
        $validatedData = $request->validate([
            'rating' => "required|numeric",
            'comment' => "required",
        ]);
        $insert = Reviews::insert([
            'parents_id' => auth()->guard('parent')->user()->id,
            'carer_providers_id' => $carer,
            'rating' => $validatedData['rating'],
            'review_body' => $validatedData['comment'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
