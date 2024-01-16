<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>PDF {{ $invoice->id_invoice }}</title>

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
            font-size: 16px;
            /* border: 2px solid #333; */
        }

        .invoice-box table tr.top table td.title {
            font-size: 16px;
            line-height: 0px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-top: 10px;
            padding-bottom: 60px;
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
                                <img src="/logo/mim2.png" style="width: 10%; max-width: 80px" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="title" style="padding-top:10px ">
                                <h3>{{ $title }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">{{ $invoice->id_invoice }}</td>
                        </tr>
                        <tr>
                            <td align="center">Jakarta,
                                {{ date('j F Y', strtotime($invoice->deliveryOrder->salesOrder->tanggal)) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td style="width: 50%">
                                <br>
                                <a class="b">Received From:</a>
                                <a>{{ $invoice->deliveryOrder->salesOrder->customer->nama }}</a>
                                <br>
                                <a>{{ $invoice->deliveryOrder->salesOrder->customer->alamat }}</a>
                                <br>
                                <a class="b">Paid to BCA Bank, PT. Medev Indo Makmur, 7120012317.</a>
                            </td>
                            <td>
                                <br>
                                <a class="b">Payment of:</a>
                                <br>
                                <a><a>Invoice, {{ $invoice->id_invoice }}</a></a>
                                <br>
                                <a class="b">Amount: Rp.
                                    {{ number_format($invoice->deliveryOrder->salesOrder->amount, 2, '.', ',') }}</a>
                                <br>
                                <a class="b">PPN: Rp.
                                    {{ number_format($invoice->deliveryOrder->salesOrder->ppn, 2, '.', ',') }}</a>
                                <br>
                                <a class="b">Grand Total: Rp.
                                    {{ number_format($invoice->deliveryOrder->salesOrder->gtotal, 2, '.', ',') }}</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="inittd">
                <td style="width: 50%"></td>
                <td class="b" style="text-align: center">
                    <a>
                        Kind Regards
                    </a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <a>Averinia</a>
                </td>
            </tr>

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
