<table border="1">


    <tr>

        <th>No</th>
        <th>Panelis</th>
        <th>Kenampakan</th>
        <th>Bau</th>
        <th>Rasa</th>
        <th>Tekstur</th>
        <th>Jumlah</th>
        <th>Rata-rata</th>

    </tr>


    @foreach($testSession->assessments as $index=>$assessment)


    @php

    $data=[];

    foreach($assessment->details as $detail){

    $data[$detail->criteria->nama_kriteria]
    =
    $detail->nilai;

    }

    @endphp



    <tr>

        <td>
            {{ $index+1 }}
        </td>


        <td>
            {{ $assessment->user->name }}
        </td>


        <td>
            {{ $data['Kenampakan'] ?? '-' }}
        </td>


        <td>
            {{ $data['Bau'] ?? '-' }}
        </td>


        <td>
            {{ $data['Rasa'] ?? '-' }}
        </td>


        <td>
            {{ $data['Tekstur'] ?? '-' }}
        </td>


        <td>
            {{ $assessment->total_nilai }}
        </td>


        <td>
            {{ number_format($assessment->nilai_akhir,2) }}
        </td>


    </tr>



    @endforeach


</table>