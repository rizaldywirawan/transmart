<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\AuctionAttachment;

class AuctionRemoveFileController extends Controller
{
    public function destroy($auctionAttachmentId)
    {
        try {
            DB::beginTransaction();
            /*
            * Auction Attachment Delete
            1. Delete File in storage
            */
            $auctionAttachment = AuctionAttachment::where('id', $auctionAttachmentId)->first();

            // 1. Delete File in storage
            Storage::disk('public')->delete($auctionAttachment->file_path);
            $auctionAttachment->deleted_by = Auth::id();
            $auctionAttachment->deleted_at = Carbon::now();
            $auctionAttachment->save();

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage(), 500]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response(['message' => $ex->getMessage(), 500]);
        }

        $response = [
            'message' => [
                'title' => "Delete",
                'text' => "Auction File has been deleted",
                'icon' => "success",
            ],
            'code' => 200
        ];

        return response($response, $response['code']);
    }
}
