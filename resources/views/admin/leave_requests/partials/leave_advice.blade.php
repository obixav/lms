@php

    // $num=count($days);
@endphp
    <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $leave_request->user->name }}-Leave Advice</title>


    <style type="text/css">
        @page {
            size: 596pt 842pt;
        }

        body {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            margin-top: -10px;
            /*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
            width: 18cm;
            height: 29.7cm;
            padding-left: 20px;
            padding-top: 70px;
            font-family: arial, sans-serif;

        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .small-font {
            font-size: 10px;
        }


        h1,
        h4 {
            font-family: arial, sans-serif;
        }

        #header td,
        #header th {
            border: 0px solid #dddddd;
            text-align: left;
            padding: 2px;
        }

        header {
            position: fixed;
            top: 20px;
            float: left;
            height: 50px;


        }

        #watermark {
            position: fixed;

            /**
                    Set a position in the page for your image
                    This should center it vertically
                **/
            top: 45%;
            width: 100%;
            height: 100%;
            opacity: 0.1;
            /*-ms-transform: rotate(310deg);  IE 9 */
            /*-webkit-transform: rotate(310deg);  Safari 3-8 */
            /*transform: rotate(310deg);*/
            padding: 300px;

            /** Your watermark should be behind every content**/
            z-index: -1000;
        }
        #footnote{
            position: fixed;
            bottom: 2%;;
            font-size: 12px;

        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>

<body>
<div id="watermark">
    {{-- <img src="{{ url('uploads/logo') . $company->logo }}" /> --}}
</div>

<div class="cont">


    <center style="color: #2f263c;">
        <img src="{{ $image  }}"
             style="height: 7rem;background-color:#fff; width: auto;">
        <br>
        <strong
            style="text-transform: capitalize;  font-size:24px; font-style:italic">{{ strtoupper($setting->company_name) }}</strong>
        <br>
        <span>Leave Advice</span>
        <h6></h6>
    </center>

    <table style="width:100%">
        <tr style="height: 200px;">
            <td  >
                Employee Name:
            </td>
            <td style="width:70%;text-align:left" >
                {{ $leave_request->user->name }}
            </td>

        </tr>
        <tr style="height: 200px;">
            <td style="width:30%;" >
                Employee Number:
            </td>
            <td style="width:70%;text-align:left" >
                {{ $leave_request->user->staff_id }}
            </td>

        </tr>
        <tr>
            <td style="width:30%;" >
                Grade:
            </td>
            <td style="width:70%;text-align:left" >
                @if ($leave_request->user->grade)
                    {{ $leave_request->user->grade->name }}
                @endif
            </td>

        </tr>
        <tr>
            <td style="width:30%;" >
                Email Addresss:
            </td>
            <td style="width:70%;text-align:left" >
                {{ $leave_request->user->email }}
            </td>

        </tr>
        <tr>
            <td style="width:30%;" >
                Location:
            </td>
            <td style="width:70%;text-align:left" >



            </td>

        </tr>
    </table>
    <br>
    <table style="width:100%;border:#000 solid 1px">
        <tr style="border:#000 solid 1px;background:#e7f3fd;">
            <th style="text-align:center; border:#000 solid 1px"  >
                Type of Leave
            </th>
            <th style="text-align:center; border:#000 solid 1px"  >
                Leave Start Date
            </th>
            <th style="text-align:center; border:#000 solid 1px"  >
                Leave End Date
            </th>
            <th style="text-align:center; border:#000 solid 1px"  >
                Number of Applied Days
            </th>
            @foreach ($approvals as $approval)
                <th style="text-align:center; border:#000 solid 1px"  >
                    Authorising Person ({{$approval->stage->name}})
                </th>
            @endforeach

            <th style="text-align:center; border:#000 solid 1px"  >
                Leave Status
            </th>
        </tr>
        <tr>
            <td style="text-align:center; border:#000 solid 1px">{{$leave_request->leave_type->name}}</td>
            <td style="text-align:center; border:#000 solid 1px">{{date("F j, Y", strtotime($leave_request->start_date))}}</td>
            <td style="text-align:center; border:#000 solid 1px">{{date("F j, Y", strtotime($leave_request->end_date))}}</td>
            <td style="text-align:center; border:#000 solid 1px">{{$leave_request->length}}</td>
            @foreach ($approvals as $approval)
                <td style="text-align:center; border:#000 solid 1px" >
                    {{$approval->approver_id>0?$approval->approver->name:""}}
                </td>
            @endforeach
            <td style="text-align:center; border:#000 solid 1px">
                {{strtoupper($leave_request->status==0?'pending':($leave_request->status==1?'approved':'rejected'))}}
            </td>
        </tr>



    </table>








</div>
</div>
</body>

</html>
