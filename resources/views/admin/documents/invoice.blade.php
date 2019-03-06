<style>
    @page{
        header: page-header;
        footer: page-footer;
        margin-top: 10px;
        margin-bottom: 100px;
    }
    .page-break {
        page-break-after: always;
    }
    body{
        font-family: Arial;
    }
    td {
        height: 25px;
    }
    th {
        font-weight: normal;
    }
</style>


    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Quotation</title>
        <style>
            /*@font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
            }*/
            body {
                /*font-family: "THSarabunNew";*/
            }
            .table_css {
                height: 25px;
                /*font-family: "THSarabunNew";*/
                font-size: 13px;
                width: 100%;
            }
            .table_css td {
                height: 25px;
                /*font-family: "THSarabunNew";*/
                font-size: 13px;
            }
            .table_css th {
                font-weight: normal;
                /*font-family: "THSarabunNew";*/
                font-size: 13px;
            }
        </style>
    </head>
    <body lang="th">
        <htmlpageheader name="page-header">
        </htmlpageheader>

        <htmlpagebody>
            <div class="row" style="margin-top: 50px; width: 100%;">
                <table class="table_css">
                    <tr>
                        <td style="width: 50%;">
                            <!-- <img src="images/logo.png" alt=""> -->
                        </td>
                        <td style="width: 50%; text-align: right;">
                            <div style='float: right; width: 100px;'>
                                <div style="position; absolute; float: right; width: 100px; border: 1px solid #00F; border-radius: 5px 5px 0px 0px;text-align: center; background-color: #00F; height:20px;padding-top: 5px;">
                                    ใบวางบิล
                                </div>
                                <div style="position; absolute; float: right; width: 100px; border: 1px solid #00F; border-radius: 0px 0px 5px 5px;text-align: center; background-color: #FFF; height:20px;padding-top: 5px;">
                                    Invoice
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table class="table_css">
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <h4 style="color: #00F;">เรียน / @user</h4>
                            <h4 style="color: #00F;">เรื่อง / @title</h4>
                            <h4><b>เลขประจำตัวผู้เสียภาษี</b>....</h4>
                            <h4><b>ที่อยู่</b>....</h4>
                        </td>
                        <td style="width: 50%; text-align:right;">
                            <h4 style="color: #00F;"> บริษัท @company_thai</h4>
                            <h4>@company_en</h4>
                            <h4>@address</h4>
                            <h4>@road @sub_district @district @province @zipcode</h4>
                            <h4>โทร/แฟกซ์ @tel, @fax</h4>
                            <h4>เลขประจำตัวผู้เสียภาษี</h4>
                            <h4>วันที่ / Date @date</h4>
                            <h4>ID @code</h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table class="table_css" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 10%;">รายการ</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 45%;">รายละเอียด</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">จำนวน</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">ราคาต่อหน่วย</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">ราคารวม</th>
                        </tr>
                        <tr>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 10%;">ITEM</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 45%;">DESCRIPTION</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">QUANTITY</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">UNIT PRICE</th>
                            <th style="padding: 5px; border: 1px solid #000; font-weight: bold; width: 15%;">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 5px; border: 1px solid #000; text-align: center;">item1</td>
                            <td style="padding: 5px; border: 1px solid #000;">description</td>
                            <td style="padding: 5px; border: 1px solid #000;text-align: center;">2</td>
                            <td style="padding: 5px; border: 1px solid #000;text-align: right; padding-right: 20px;">20,000.00</td>
                            <td style="padding: 5px; border: 1px solid #000;text-align: right;">40,000.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="color: #F00; font-size: 12px; text-align: left;">รายละเอียดการชำระเงิน</th>
                            <th colspan="2" style="text-align: right;">ราคารวมสินค้า / Total</th>
                            <th style="text-align: right;">40,000.00</th>
                        </tr>
                        <tr>
                            <th colspan="2" style="font-size: 12px; text-align: left;"><b>ชื่อบัญชี</b>.....</th>
                            <th colspan="2" style="text-align: right;">ภาษีมูลค่าเพิ่ม 7% / Vat 7%</th>
                            <th style="text-align: right;">2,700.00</th>
                        </tr>
                        <tr>
                            <th colspan="2" style="font-size: 12px; text-align: left;"><b>เลขที่บัญชี</b></th>
                            <th colspan="2" style="text-align: right;">จำนวนเงินรวมทั้งสิ้น / Total Price</th>
                            <th style="text-align: right;">42,700.00</th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-size: 12px; text-align: left;"><b>ธนาคาร</b></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-size: 12px; text-align: left;"><b>ชื่อบัญชี</b></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-size: 12px; text-align: left;"><b>เลขที่บัญชี</b></th>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-size: 12px; text-align: left;"><b>ธนาคาร</b></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 50%; text-align: center; vertical-align: top;">
                            <p>_______________________________</p>
                            <p>(นาย .......................)</p>
                            <p>@position</p>
                        </td>
                        <td style="width: 50%; text-align: center; vertical-align: top;"><p>_______________________________</p></td>
                    </tr>
                </table>
            </div>
        </htmlpagebody>

        <htmlpagefooter name="page-footer">
            <div style="padding-bottom: 0px;text-align: center; font-size: 10px;">
                <!-- <div align="center"><b>{PAGENO} of {nbpg}</b></div> -->
            </div>
        </htmlpagefooter>
    </body>
