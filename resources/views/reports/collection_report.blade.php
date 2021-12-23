<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta name=Title content="Collection Report">
    <meta name=Keywords content="">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <title>Collection Report</title>
</head>


<body link="#336887" vlink=purple class="xl65" style="-webkit-print-color-adjust: exact; ">
    <div class="w-4/5 text-center m-auto mt-5 mb-5" id="print">
        <button onclick="window.print()"
            class="bg-green-600 px-8 py-1 text-white font-semibold rounded text-center m-auto">Print</button>
    </div>
    @include('layouts.report_top')
    <table>
        <tbody>
            <table border=0 cellpadding=0 cellspacing=0 width=810 class="m-auto"
                style='border-collapse:collapse;width:606pt' id="main_table">
                <thead>
                    <tr>
                        <th colspan="100%">
                            <table width="100%">
                                <tr height=24>
                                    <td width="20%" height=24 class="xl156 text-center" style='height:18.0pt'>Report
                                        Name
                                    </td>
                                    <td width="15%" class="xl156 text-center" style='border-left:none'>Report Type
                                    </td>
                                    <td width="15%" class="xl156 text-center" style='border-left:none'>Report Date
                                    </td>
                                    <td width="30%" class="xl156 text-center" style='border-left:none'>Authorized
                                        Person
                                    </td>
                                    <td width="20%" class="xl156 text-center"
                                        style='border-right:.5pt solid #B2B2B2;border-left:none'>Authorized
                                        Signatory</td>
                                </tr>
                                <tr height=24>
                                    <td height=24 class="xl175 text-center font-semibold" style='height:18.0pt'>
                                        Collection Report
                                    </td>
                                    <td class="xl175 text-center" style='border-left:none'>
                                        <?php  
                                        if($_GET['report_type'] == 'all')
                                        {
                                        ?>
                                        All Report
                                        <?php
                                        }
                                        elseif($_GET['report_type'] == 'date')
                                        {
                                            ?>
                                        Custom
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <th class="xl175 text-center" width=131 style='border-left:none;width:98pt'>
                                        <?php  
                                        if($_GET['report_type'] == 'all')
                                        {
                                        ?>
                                        ---------
                                        <?php
                                        }
                                        elseif($_GET['report_type'] == 'date')
                                        {
                                            ?>
                                        {{ date('jS M Y', strtotime($_GET['date'])) }}
                                        <?php
                                        }
                                        ?>
                                        </td>
                                    <td class="xl175 text-center" width=127 style='border-left:none;width:95pt'>
                                        &nbsp;</td>
                                    <td class="xl175 text-center"
                                        style='border-right:.5pt solid #B2B2B2;border-left:none'>
                                        &nbsp;</td>

                                </tr>
                                <tr height=9 style='mso-height-source:userset;height:7.5pt'>
                                    <td height=9 class=xl75 style='height:7.5pt'>&nbsp;</td>
                                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                                </tr>
                            </table>
                        </th>
                    </tr>

                    <tr height=24>
                        <th height=24 width="10%" class="xl113 text-center" style='height:18.0pt'>#</th>
                        <th height=24 width="30%" class="xl113 text-center" style='height:18.0pt'>
                            Transcation</th>
                        <th height=24 width="20%" class="xl113 text-center" style='height:18.0pt'>Debit</th>
                        <th height=24 width="20%" class="xl113 text-center" style='height:18.0pt'>Credit
                        </th>
                        <th width="20%" class="xl113 text-right pr-4">Total Amount (₹)</th>
                    </tr>

                </thead>
                <tbody>

                    <tr height=24>
                        <td height=24 width="10%" class="xl123 text-center" style='height:18.0pt'>1</td>
                        <td height=24 width="30%" class="xl123 text-center" style='height:18.0pt'>Deposit Collection
                        </td>
                        <td height=24 width="20%" class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 width="20%" class="xl123 text-center" style='height:18.0pt'></td>
                        <td width="20%" class="xl123 text-right pr-4">
                            {{ number_format((float)$total_deposit_amount, 2, '.', '') }}/-</td>
                    </tr>
                    <tr height=24 class="bg-gray-200">
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>2</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Late Fine</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'></td>
                        <td class="xl123 text-right pr-4">
                            {{ number_format((float)$total_deposit_late_fine_amount, 2, '.', '') }}/-
                        </td>
                    </tr>
                    <tr height=24>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>3</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Interest Collection</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'></td>
                        <td class="xl123 text-right pr-4">
                            {{ number_format((float)$total_interest_amount, 2, '.', '') }}/-</td>
                    </tr>
                    <tr height=24 class="bg-gray-200">
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>4</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Previous Interest Due</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'></td>
                        <td class="xl123 text-right pr-4">
                            {{ number_format((float)$total_pre_interest_amount, 2, '.', '') }}/-
                        </td>
                    </tr>
                    <tr height=24>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>5</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Fine on Interest Non Payment
                        </td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'></td>
                        <td class="xl123 text-right pr-4">
                            {{ number_format((float)$total_interest_late_fine_amount, 2, '.', '') }}/-
                        </td>
                    </tr>
                    <tr height=24 class="bg-gray-200">
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>6</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Loan Repayment</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'>Debit (+)</td>
                        <td height=24 class="xl123 text-center" style='height:18.0pt'></td>
                        <td class="xl123 text-right pr-4">
                            {{ number_format((float)$total_disbursed_amount, 2, '.', '') }}/-
                        </td>
                    </tr>

                    <tr height=9>
                        <td height=9 class=xl97 style='height:7.5pt'></td>
                        <td class=xl98></td>
                        <td class=xl99></td>
                        <td class=xl99></td>
                        <td class=xl99></td>
                        <td class=xl99></td>

                    </tr>
                </tbody>
            </table>
            <table border=0 cellpadding=0 cellspacing=0 width=810 class="m-auto"
                style='border-collapse: collapse;width:606pt' id="bottom_table">
                <tr height=24>
                    <td colspan=8 height=24 class=xl167 style='height:18.0pt'>Special Notes and
                        Instructions</td>
                    <td class=xl88 width=50>&nbsp;</td>
                    <td class="xl101 font-bold text-center" style='border-left:none'>Total Collection</td>
                    <td class="xl102 font-bold">₹</td>
                    <td class="xl103 font-bold pr-4"><span
                            style='mso-spacerun:yes'> </span>{{ $total_collection_amount }}/-
                    </td>
                </tr>
                <tr height=24>
                    <td colspan=8 height=24 class=xl171 style='height:18.0pt'>&nbsp;</td>
                    <td class=xl88>&nbsp;</td>
                    <td colspan=3 class=xl89 style='border-top:none'>&nbsp;</td>
                </tr>
                <tr height=24>
                    <td colspan=8 height=24 class=xl171 style='height:18.0pt'>&nbsp;</td>
                    <td class=xl88>&nbsp;</td>
                    <td colspan=3 class=xl89 style='border-top:none'>&nbsp;</td>
                </tr>
                <tr height=24>
                    <td colspan=8 height=24 class=xl171 style='height:18.0pt'>&nbsp;</td>
                    <td class=xl88>&nbsp;</td>
                    <td colspan=3 class="xl167 text-center">Authorized Signatory</td>
                </tr>
                <tr height=24>
                    <td colspan=8 height=24 class=xl171 style='height:18.0pt'>&nbsp;</td>
                    <td class=xl88>&nbsp;</td>
                    <td colspan=3 height=24 class=xl171 style='height:18.0pt'>&nbsp;</td>
                </tr>
                <tr height=24>
                    <td colspan=8 height=24 class=xl166 style='height:18.0pt'>&nbsp;</td>
                    <td class=xl88>&nbsp;</td>
                    <td colspan=3 height=24 class=xl166 style='height:18.0pt'>&nbsp;</td>
                </tr>
                <tr height=9 style='mso-height-source:userset;height:7.5pt'>
                    <td height=9 class=xl79 style='height:7.5pt'>&nbsp;</td>
                    <td class=xl79 style='border-left:none'>&nbsp;</td>
                    <td class=xl79 style='border-left:none'>&nbsp;</td>
                    <td class=xl80 style='border-left:none'>&nbsp;</td>
                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                    <td class=xl79 style='border-left:none'>&nbsp;</td>
                    <td class=xl75 style='border-left:none'>&nbsp;</td>
                    <td class=xl73 style='border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl74 style='border-left:none'>&nbsp;</td>
                    <td class=xl74 style='border-left:none'>&nbsp;</td>
                    <td class=xl74 style='border-left:none'>&nbsp;</td>
                </tr>
                <tr height=24>
                    <td colspan=12 height=24 class=xl129 style='border-right:.5pt solid white; height:18.0pt'>
                        Thank
                        you....!</td>
                </tr>
                <tr height=9 style='mso-height-source:userset;height:7.5pt'>
                    <td height=9 class=xl65 style='height:7.5pt;border-top:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl71 style='border-top:none'>&nbsp;</td>
                    <td class=xl71 style='border-top:none'>&nbsp;</td>
                    <td class=xl71 style='border-top:none'>&nbsp;</td>
                    <td class=xl65 style='border-top:none;border-left:none'>&nbsp;</td>
                </tr>

                <tr height=24>
                    <td colspan=12 height=24 class=xl126 style='border-right:.5pt solid white;height:18.0pt'>
                        This
                        Society is managed by Fintical.com</td>
                </tr>
                <tr height=9 style='mso-height-source:userset;height:7.5pt'>
                    <td height=9 class=xl78 style='height:7.5pt;border-top:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                    <td class=xl78 style='border-top:none;border-left:none'>&nbsp;</td>
                </tr>
                <tr height=16 style='mso-height-source:userset;height:12.75pt'>
                    <td colspan=12 height=16 class="xl132 text-xs"
                        style='border-right:.5pt solid white; height:12.75pt'>
                        Fintical.com is a Society financial
                        management system and will not be responsible for any financial
                        or monetary discrepancy.</td>
                </tr>
                <tr height=24>
                    <td colspan=12 height=24 class=xl172> E-mail: service@fintical.com Web: www.fintical.com</td>
                </tr>
        </tbody>
    </table>

    </tbody>
    </table>
    <div class="w-4/5 text-center m-auto my-5" id="print">
        <button onclick="window.print()"
            class="bg-green-600 px-8 py-1 text-white font-semibold rounded text-center m-auto">Print</button>
    </div>
</body>

</html>