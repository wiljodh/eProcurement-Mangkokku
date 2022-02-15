<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;
use App\Models\TmTender;
use App\Models\TmTenderCategory;
use App\Models\TmTenderStatus;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TenderController extends Controller
{
    use CommonTrait;

    public function common_show_tender_attachment(Request $request, $id)
    {
        $tender = TmTender::find($id);
        if ($tender->hasPDF()) {

            $path = asset('storage/' . $tender->attachment_path);
            // dd($path);

            return response()->file($path);

        } else {
            return abort(404);
        }

    }

    public function account_show_create_tender(Request $request)
    {
        $tenderCategories = TmTenderCategory::where('active', 1)->get();
        $tenderStatus = TmTenderStatus::where('id', '<>', 0)->get();
        return view('account.tender_create.index', compact('tenderCategories', 'tenderStatus'));
    }

    public function account_show_categorries(Request $request)
    {
        $tenderCategories = TmTenderCategory::where('active', 1)->get();
        return view('account.tender_categorries.index', compact('tenderCategories'));
    }
    public function account_show_create_category(Request $request)
    {
        $tenderCategories = TmTenderCategory::where('active', 1)->get();
        return view('account.tender_category_create.index');
    }

    public function account_show_draft_tenders()
    {
        $draftTenders = TmTender::where('tm_tender_status_id', 2)->get();
        return view('account.draft_tenders.index', compact('draftTenders'));
    }
    public function account_show_edit_draft_tenders($tenderId)
    {
        $tenderDetails = TmTender::find($tenderId);
        $tenderCategories = TmTenderCategory::where('active', 1)->get();
        $tenderStatus = TmTenderStatus::where('id', '<>', 0)->get();
        return view('account.edit_tender.index', compact('tenderDetails', 'tenderCategories', 'tenderStatus'));
    }
    public function account_show_edit_category($categoryId)
    {
        $categoryDetails = TmTenderCategory::find($categoryId);
        return view('account.tender_edit_categories.index', compact('categoryDetails'));

    }

    public function account_show_tender($tenderId)
    {
        $tenderDetails = TmTender::find($tenderId);
        
        return view('account.view_tender.index', compact('tenderDetails'));
    }

    public function account_show_Offer_avilable_tenders(Request $request)
    {
        $Offer_avilable_tenders = TmTender::where("tm_tender_status_id","=",config("global.tender_publish"))->cursor()->filter(function ($tender) {
            return count($tender->offers()->get()) > 0;
        });
 
        return view('account.tenders_offer_avilable.index', compact('Offer_avilable_tenders'));
    }
  


    /*
     * Tender create function
     */

    public function createTender(Request $request)
    {
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id = $userSession->id;

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status' => 'required|exists:tm_tender_status,id',
                'deposit' => 'required|numeric',
                'estimate_cost' => 'required|numeric',
                'location' => 'sometimes',
                'attachment' => 'sometimes|file|mimetypes:application/pdf',
                'category_id' => 'required|exists:tm_tender_category,id',
            ], [
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'category_id.required' => 'Category is required.',
                'tender_status.exists' => 'should be valid status',
                'attachment.file' => 'File not uploaded correctly',
                'category_id.exists' => 'category not avilable',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $maxId = TmTender::max("id");
            $tenderId = $this->common_generate_next_tender_no($maxId);

            $start_date = Carbon::parse($request->get('start_date'));
            $end_date = Carbon::parse($request->get('end_date'));

            $attachment_path = "";
            if ($request->hasFile('attachment')) {
                $extension = $request->file('attachment')->extension();
                $file_name = $tenderId . "." . $extension;
                $attachment_path = $request->attachment->storeAs('upload_files', $file_name);
            }

            $tender = TmTender::create([
                'id' => $tenderId,
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'start_date' => $start_date->format('Y-m-d 00:00:00'),
                'end_date' => $end_date->format('Y-m-d 23:59:59'),
                'tm_tender_status_id' => $request->get('tender_status'),
                'crby' => $user_id,
                'deposit' => $request->get('deposit'),
                'estimate_cost' => $request->get('estimate_cost'),
                'location' => $request->get('location'),
                'tm_tender_category_id' => $request->get('category_id'),
                'attachment_path' => $attachment_path,

            ]);

            DB::commit();

            session()->flash('message', "successfully saved");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->back();

        } catch (\Exception $th) {
            DB::rollBack();
            session()->flash('message', $th->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    /*
     * Tender Update function (Only drafts)
     */

    public function updateTender(Request $request)
    {
        try {
            $userSession = $request->session()->get(config("global.session_user_obj"));
            $user_id = $userSession->id;

            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:tm_tender',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required|after_or_equal:today',
                'end_date' => 'required|after_or_equal:today',
                'tender_status' => 'required|exists:tm_tender_status,id',
                'deposit' => 'required|numeric',
                'estimate_cost' => 'required|numeric',
                'location' => 'sometimes',
                'category_id' => 'required|exists:tm_tender_category,id',
                'attachment' => 'sometimes|file|mimetypes:application/pdf',
                // 'has_attachment' => 'boolean',
                // 'has_old_attachment' => 'boolean',
            ], [
                'title.required' => ':attribute is required.',
                'description.required' => ':attribute  is required.',
                'start_date.required' => 'Start date is required.',
                'end_date.required' => 'End date is required.',
                'deposit.required' => 'Deposite amount is required.',
                'estimate_cost.required' => 'Estimate cost amount is required.',
                'location.sometimes' => 'Location cannot be empty',
                'category_id.required' => 'Category is required.',
                'tender_status.exists' => 'should be valid status',
                'category_id.exists' => 'category not avilable',
                'attachment.file' => 'File not uploaded correctly',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $tender = TmTender::find($request->get("id"));

            if ($tender->tm_tender_status_id !== config("global.tender_draft")) {
                throw new Exception("Only draft tenders can update");
            }

            $hasAttachment = $request->get("has_attachment");
            $hasOldAttachment = $request->get("has_old_attachment");

            $attachment_path = "";
            if ($hasAttachment && $request->hasFile('attachment')) {
                $extension = $request->file('attachment')->extension();
                $file_name = $tender->id . "." . $extension;
                $attachment_path = $request->attachment->storeAs('upload_files', $file_name);
            }

            $start_date = Carbon::parse($request->get('start_date'));
            $end_date = Carbon::parse($request->get('end_date'));

            $tender->title = $request->get('title');
            $tender->description = $request->get('description');
            $tender->start_date = $start_date->format('Y-m-d 00:00:00');
            $tender->end_date = $end_date->format('Y-m-d 23:59:59');
            $tender->tm_tender_status_id = $request->get('tender_status');
            $tender->deposit = $request->get('deposit');
            $tender->estimate_cost = $request->get('estimate_cost');
            $tender->location = $request->get('location');
            $tender->tm_tender_category_id = $request->get('category_id');

            if ($hasAttachment) {
                if ($attachment_path !== "") {
                    $tender->attachment_path = $attachment_path;
                } else if ($hasOldAttachment === false) {
                    throw new Exception("If you select has attachment option , you must to add an attachment");
                }
            } else {
                $tender->attachment_path = "";
            }

            $tender->save();

            DB::commit();

            session()->flash('message', "successfully updated");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    /*
     * Tender category create
     */
    public function createTenderCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'icon' => 'required',
            ], [
                'name.required' => ':attribute is required.',
                'icon.required' => ':attribute  is required.',
            ]);

            DB::beginTransaction();

            $maxId = TmTenderCategory::max("id");

            $catId = ($maxId + 1);

            $tenderCat = TmTenderCategory::create([
                'id' => $catId,
                'name' => $request->get('name'),
                'sym' => "CAT_" . $catId,
                'active' => 1,
                'icon' => 'fa ' . $request->get('icon'),
            ]);

            DB::commit();

            session()->flash('message', "successfully saved");
            session()->flash('flash_message_type', config("global.flash_success"));

            return redirect()->action([TenderController::class, 'account_show_categorries']);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    public function deleteTenderCategory(Request $request, $id)
    {
        try {
            $tenderCategory = TmTenderCategory::find($id);

            if (count($tenderCategory->tenders()->get()) > 0) {
                throw new Exception("has attached tenders");
            } else {
                $tenderCategory->delete();
            }
            session()->flash('message', "Deleted category successfully");
            session()->flash('flash_message_type', config("global.flash_success"));
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

    public function updateTenderCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'icon' => 'required',
            ], [
                'name.required' => ':attribute is required.',
                'icon.required' => ':attribute  is required.',
            ]);

            DB::beginTransaction();

            $tenderCategory = TmTenderCategory::find($request->get("id"));
            $tenderCategory->name = $request->get('name');
            $tenderCategory->icon = $request->get('icon');
            $tenderCategory->save();
            DB::commit();

            session()->flash('message', "successfully saved");
            session()->flash('flash_message_type', config("global.flash_success"));

            return redirect()->action([TenderController::class, 'account_show_categorries']);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e->getMessage());
            session()->flash('flash_message_type', config("global.flash_error"));
            return redirect()->back();
        }
    }

}
