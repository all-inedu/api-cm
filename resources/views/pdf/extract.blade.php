<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Progress</title>
    <style>
        table.table {
            border-collapse: collapse;
            border-color: #d5d5d5;
            width: 100%;
        }
        table.table tr.outline-name {
            background-color: #6C757D;
            font-weight: bold;
            color: #FFF;
            border-top: 2px solid #212529;
        }
        table.table tr.header {
            font-weight: bold;
        }
        table.table tr td {
            padding: 1em;
        }
        table.table tr td.nopadding {
            padding: 0 !important;
        }
        ul.list-none {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        table.table img {
            max-width: auto;
            width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <table class="table" border="1">
        <tr class="header" align="center">
            <td width="2%">No</td>
            <td width="20%">Part Name</td>
            <td width="78%">Question / Answer</td>
        </tr>
        @foreach ($answer['outlines'] as $outline)
            @foreach ($outline['parts'] as $part)
            <?php $no = 1; ?>
                <tr class="outline-name" align="center">
                    <td colspan="3">{{ $outline->name }}</td>
                </tr>
                <tr>
                    <td>{{ $no++; }}</td>
                    <td>{{ $part->title }}</td>
                    <td class="nopadding">
                        <table class="table" border="1">
                            <tr class="header" align="center">
                                <td width="70%">Question</td>
                                <td width="30%">Answer</td>
                            </tr>
                            <tbody>
                                @foreach ($part['elements'] as $element)
                                <tr>
                                    <td>{!! $element->question !!}</td>
                                    <td align="center">
                                        {{-- {{ $element }} --}}
                                        @switch ($element->category_element)
                                            @case("multiple")
                                                <ul class="list-none">
                                                @foreach ($element['answersdetails'] as $answer_detail)
                                                    <li>{{ $answer_detail->answer }}</li>
                                                @endforeach
                                                </ul>
                                                @break

                                            @case("blank")
                                                <ul class="list-none">
                                                @foreach ($element['answersdetails'] as $answer_detail)
                                                    <li>{{ $answer_detail->answer }}</li>
                                                @endforeach
                                                </ul>
                                                @break
                                            
                                            @case("file")
                                                <a href="{{ url('/'.$element->file_path) }}">
                                                    <button>Download Now</button>
                                                </a>
                                                @break
                                        @endswitch

                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </table>
</body>
</html>