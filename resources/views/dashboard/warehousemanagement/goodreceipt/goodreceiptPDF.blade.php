<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PDF {{ $goodReceipt->id_goodreceipt }}</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); */
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .b {
            font-weight: bold;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 0px;
            padding-top: 0px;
            font-size: 0px;
            /* border: solid 1px #333; */
        }

        .invoice-box table tr.top table td.title {
            font-size: 16px;
            line-height: 0px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-top: 10px;
            padding-bottom: 5px;
            font-size: 14px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            text-align: center;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #ffffff;
            text-align: center;
        }

        .invoice-box table tr.iniTotal td {
            border: 1px solid #ffffff;
            font-size: 14px
        }

        .invoice-box table tr.inittd td {
            border: 1px solid #ffffff;
            font-size: 14px
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="/logo/mim2.png" style="width: 10%; max-width: 80px">
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="title">
                                <h3>{{ $title }}</h3>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td style="width: 50%">
                                <a class="b">GR Number:</a>
                                <a>{{ $goodReceipt->id_goodreceipt }}</a>
                                <br>
                                <a class="b">Principals:</a>
                                <a>{{ $goodReceipt->purchaseOrder->principal->nama }}</a>
                                <br>
                                <a class="b">Address:</a>
                                <br>
                                <a>{{ $goodReceipt->purchaseOrder->principal->alamat }}</a>
                            </td>
                            <td>
                                <a class="b">Delivery Order:</a>
                                <a>{{ $goodReceipt->suratjalan }}</a>
                                <br>
                                <a class="b">Purchase Order:</a>
                                <a>{{ $goodReceipt->purchaseOrder->id_purchaseorder }}</a>
                                <br>
                                <a class="b">Received By:</a>
                                <a>{{ $goodReceipt->user->username }}</a>
                                <br>
                                <a class="b">Received Date:</a>
                                <a>{{ $goodReceipt->tanggal }}</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>No</td>
                <td>Part</td>
                <td>Part Desc</td>
                <td>UOM</td>
                <td>Qty</td>
                <td>Lot</td>
                <td>Exp Date</td>
            </tr>
            @foreach ($goodReceipt->goodReceiptItem as $i)
                <tr class="item">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $i->part->kd_parts }}</td>
                    <td>{{ $i->part->nama }}</td>
                    <td>{{ $i->part->uom->nama }}</td>
                    <td>{{ $i->qty }}</td>
                    <td>{{ $i->lot->kd_lots }}</td>
                    <td>{{ $i->lot->exp }}</td>
                </tr>
            @endforeach
            {{-- <tr class="details">
                <td colspan="1">Penerima:</td>
            </tr> --}}
            @for ($l = 0; $l <= 5; $l++)
                <tr>
                    <td><br></b></td>
                </tr>
            @endfor

        </table>
    </div>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
