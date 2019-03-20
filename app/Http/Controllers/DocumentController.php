<?php
namespace Laraspace\Http\Controllers;
use Exception;
use Laraspace\User;
use \Mpdf\Mpdf;
use Validator;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function create_quotation(Request $request) {
        $data['bank'] = \Laraspace\Models\Bank::get();
        $data['segment'] = $request->segment(3);
        $data['customer'] = \Laraspace\Models\CustomerCompany::get();
        $data['bank'] = \Laraspace\Models\Bank::get();
        return view('admin/documents.create_quotation', $data);
    }
    public function create_invoice(Request $request, $id = null) {
        $data['segment'] = $request->segment(3);
        try {
            if($id == null) {
                throw new Exception("Please choose quotation");
            }
            $data['customer'] = \Laraspace\Models\CustomerCompany::get();
            return view('admin/documents.create_invoice', $data);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function create_tax_invoice(Request $request, $id = null) {
        $data['segment'] = $request->segment(3);
        try {
            if($id == null) {
                throw new Exception("Please choose quotation");
            }
            $data['customer'] = \Laraspace\Models\CustomerCompany::get();
            return view('admin/documents.create_tax_invoice', $data);
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function quotation($id = null) {
        try {
            if($id == null) {
                throw new Exception("Please choose quotation");
            }
            $data['data'] = [];
            // return view('admin.documents.quotation', $data);
            $mpdf = new Mpdf(['autoLangToFont' => true]);
            $view = view('admin.documents.quotation', $data);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function invoice($id = null) {
        try {
            if($id == null) {
                throw new Exception("Please choose quotation");
            }
            $data['data'] = [];
            // return view('admin.documents.invoice', $data);
            $mpdf = new Mpdf(['autoLangToFont' => true]);
            $view = view('admin.documents.invoice', $data);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function tax_invoice($id = null) {
        try {
            if($id == null) {
                throw new Exception("Please choose quotation");
            }
            $data['data'] = [];
            // return view('admin.documents.invoice', $data);
            $mpdf = new Mpdf(['autoLangToFont' => true]);
            $view = view('admin.documents.tax_invoice', $data);
            $mpdf->WriteHTML($view);
            $mpdf->Output();
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function generate_no($type) {
        $result = \Laraspace\Models\Invoice::where('invoice_type', $type)->orderBy('id', 'desc')->first();
        $number = 0;
        if($result!=null) {
            preg_match_all('!\d+!', $result->invoice_no, $number);
            $number = $number[0][0];
        }
        return json_encode(++$number);
    }

    public function store_quotation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = $request->all();
                $data_insert['created_at'] = date('Y-m-d H:i:s');
                $data_contact = $data_insert['contact'];
                $data_contact['created_at'] = date('Y-m-d H:i:s');
                $data_item = $data_insert['item'];
                unset($data_insert['contact'], $data_insert['item'], $data_insert['_token']);
                $data_insert['contact_information_id'] = \Laraspace\Models\Contactinformation::insertGetId($data_contact);
                $data_insert['customer_company_id'] = $data_insert['contact']['customer_company_id'];
                $invoice_id = \Laraspace\Models\Invoice::insertGetId($data_insert);
                foreach($data_item as $k => $v) {
                    $v['invoice_id'] = $invoice_id;
                    $v['created_at'] = date('Y-m-d H:i:s');
                    \Laraspace\Models\InvoiceDetail::insert($data_item);
                }
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Finish';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Fail'.$e->getMessage();
            }
        }else{
            $failedRules = $validator->failed();
            if(isset($failedRules['email']['Unique'])) {
                $return['status'] = 2;
                $return['content'] = 'Email duplicate';
            } else {
                $return['status'] = 0;
            }
        }
        $return['title'] = 'Edit data';
        return json_encode($return);
    }
    public function store_invoice(Request $request)
    {
        dd($request->all());
    }
    public function store_tax_invoice(Request $request)
    {
        dd($request->all());
    }
}
