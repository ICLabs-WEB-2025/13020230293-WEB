<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laporan Komentar' }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
            line-height: 1.4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .date {
            text-align: center;
            font-size: 10px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title ?? 'Laporan Komentar Siswa' }}</h1>
        <p class="date">Tanggal Cetak: {{ $date ?? date('d F Y') }}</p>

        @if(isset($comments) && $comments->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Note</th>
                        <th>Dikirim Pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->nama }}</td>
                        <td>{{ $comment->email }}</td>
                        <td>{{ $comment->kelas }}</td>
                        <td>{{ $comment->komentar }}</td> {{-- Di PDF, tampilkan komentar penuh --}}
                        <td>{{ $comment->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Tidak ada data komentar untuk ditampilkan.</p>
        @endif
    </div>
</body>
</html>
