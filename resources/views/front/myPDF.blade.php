<!DOCTYPE html>
<html>

<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <style>
        body {
            background-image: url({{ $background }});
            background-size: cover;
            /* background-repeat: no-repeat; */
        }

        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            padding: 10px 45px 0px 45px;
        }


        td label:first-child {
            font-weight: bold;
        }

        td label {
            font-weight: normal;
        }




        .table#less-space td,
        .table#less-space th {
            padding: 0px 0.75rem;
        }

        .table-bordered td {
            padding: 7px
        }

        .footer {
            position: fixed;
            bottom: 0px;
            left: 45px;
            right: 45px;
        }

        .footer .table-borderless td {
            padding: 0px
        }
    </style>

</head>

<body class="landscape2">
    <div style="padding: 5px 5px 5px 5px;">
        <div class="text-center"><img src="{{ $logo }}" width="100"></div>
        <h1 class="text-center">{{ $title }}</h1>
        <p class="text-center" style="font-weight: bold;font-size:20px">{{ $sub_title }}</p>
        <table class="table table-borderless mt-4" id="less-space">
            <tbody>
                <tr>
                    <td width="40%"><label>Entrance No:</label> <label>{{ $student[0]->entrance_no }}</label></td>
                    <td width="30%"><label>Year: </label> <label>{{ $student[0]->year }}</label></td>
                    <td width="30%"><label>Roll No: </label><label>{{ $student[0]->roll_no }}</label></td>
                </tr>
                <tr>
                    <td colspan="1"><label>Student Name:</label> <label>{{ $student[0]->student_name }} </label>
                    </td>
                    <td colspan="2"><label>Father's Name:</label> <label>{{ $student[0]->father_name }}</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="1"><label>Mother's Name: </label> <label>{{ $student[0]->mother_name }}</label></td>
                    <td colspan="2"><label>Class: </label> <label>{{ $student[0]->class }}</label></td>

                </tr>
            </tbody>
        </table>

        <table class="table table-borderless" style="margin-bottom: 5px;">
            <tr style="font-weight: bold;">
                <td rowspan="2" style="vertical-align: center;">Subjects</td>
                <td colspan="2">Half Yearly</td>
                <td colspan="2">Yearly</td>
                <td colspan="2">Total</td>
            </tr>
            <tr style="font-weight: bold;">
                <td>Total</td>
                <td>Obtained</td>
                <td>Total</td>
                <td>Obtained</td>
                <td>Total</td>
                <td>Obtained</td>
            </tr>
            @php
                $htotal = $hobtained = $yhtotal = $yobtained = 0;
            @endphp

            @foreach ($student[0]->marks as $marks)
                <tr>
                    <td>{{ $marks->subjects }}</td>
                    <td>{{ $marks->half_yearly_max_marks }}</td>
                    <td>{{ $marks->half_yearly_obtained }}</td>
                    <td>{{ $marks->yearly_total_marks }}</td>
                    <td>{{ $marks->yearly_obtained_marks }}</td>
                    <td>{{ $marks->half_yearly_max_marks + $marks->yearly_total_marks }}</td>
                    <td>{{ $marks->half_yearly_obtained + $marks->yearly_obtained_marks }}</td>
                </tr>
                @php
                    $htotal += $marks->half_yearly_max_marks;
                    $hobtained += $marks->half_yearly_obtained;
                    $yhtotal += $marks->yearly_total_marks;
                    $yobtained += $marks->yearly_obtained_marks;
                @endphp
            @endforeach

            <tr>
                <td>Total</td>
                <td>{{ $htotal }}</td>
                <td>{{ $hobtained }}</td>
                <td>{{ $yhtotal }}</td>
                <td>{{ $yobtained }}</td>
                <td>{{ $htotal + $yhtotal }}</td>
                <td>{{ $hobtained + $yobtained }}</td>
            </tr>
        </table>
        <div class="footer">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td class="text-left"><label>.........................................</label></td>
                        <td class="text-center"><label>................................</label></td>
                        <td class="text-right"><label>................................</label></td>
                    </tr>
                    <tr>
                        <td class="text-left"><label>Signature Class Teacher</label></td>
                        <td class="text-center"><label>Signature Checker</label></td>
                        <td class="text-right"><label>Signature Principal</label></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
