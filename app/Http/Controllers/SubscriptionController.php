<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request) {
        $validated = $request->validate([
            'bundle_id'=>'required|integer|exists:bundles,id',
        ]);

        $userId = auth()->user()->id;

        $subscription = new Subscription();
        $subscription->user_id = $userId;
        $subscription->bundle_id = $validated['bundle_id'];

        try{
            $subscription->save();
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to Save Subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readAllSubscriptions() {
        try{
            $subscriptions = Subscription::all();
            return response()->json($subscriptions);
        }
        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch Subscriptions.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function readSubscription($id) {
        try{
            $subscription = Subscription::findOrFail($id);
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to fetch the subscription with ID.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function updateSubscription(Request $request, $id) {
        $validated = $request->validate([
            'bundle_id'=>'required|integer|exists:bundles,id',
        ]);

        try{
            $subscription = Subscription::findOrFail($id);

            $subscription->user_id = $validated['user_id'];
            $subscription->bundle_id = $validated['bundle_id'];
            
            $subscription->save();
            return response()->json($subscription);
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to update the subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function deleteSubscription($id) {
        try{
            $subscription = Subscription::findOrFail($id);
            $subscription->delete();
            return response("Subscription deleted successfully!");
        }

        catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to delete the subscription.',
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function getUserCharges() {
        $user = auth()->user();
        $userId = $user->id;

        $userCharge = Subscription::where('user_id', $userId)
                        ->join('users', 'subscriptions.user_id', '=', 'users.id')
                        ->join('bundles', 'subscriptions.bundle_id', '=', 'bundles.id')
                        ->sum('bundles.value');
        return response()->json([
            'user'=>$user->name,
            'total_charge'=>$userCharge,
        ], 200);
    }
}
