<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suara Warga</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-8 text-blue-600">📢 SUARA WARGA</h1>

        <div class="bg-white p-6 rounded-lg shadow-md mb-10">
            <h2 class="text-xl font-bold mb-4">Buat Laporan Baru v2</h2>
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="text" name="reporter_name" placeholder="Nama Anda" class="w-full p-2 border rounded" required>
                <input type="text" name="title" placeholder="Judul Laporan (Misal: Jalan Berlubang)" class="w-full p-2 border rounded" required>
                <textarea name="description" placeholder="Deskripsi lengkap..." class="w-full p-2 border rounded" required></textarea>
                
                <div>
                    <label class="block text-sm font-bold mb-1">Bukti Foto:</label>
                    <input type="file" name="image" class="w-full p-2 border rounded" required>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700">KIRIM LAPORAN</button>
            </form>
        </div>

        <div class="space-y-6">
            @foreach($reports as $report)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $report->image_path) }}" alt="Bukti" class="w-full h-64 object-cover">
                
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-xs text-gray-500">{{ $report->created_at->diffForHumans() }} • Oleh {{ $report->reporter_name }}</span>
                            <h3 class="text-xl font-bold mt-1">{{ $report->title }}</h3>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                            {{ $report->status == 'pending' ? 'bg-gray-200 text-gray-700' : '' }}
                            {{ $report->status == 'process' ? 'bg-yellow-200 text-yellow-800' : '' }}
                            {{ $report->status == 'done' ? 'bg-green-200 text-green-800' : '' }}">
                            {{ $report->status }}
                        </span>
                    </div>
                    
                    <p class="text-gray-700 mt-4">{{ $report->description }}</p>

                    <div class="mt-6 pt-4 border-t flex gap-2">
                        <form action="{{ route('reports.update', $report->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button name="status" value="process" class="text-xs bg-yellow-500 text-white px-2 py-1 rounded">Proses</button>
                            <button name="status" value="done" class="text-xs bg-green-500 text-white px-2 py-1 rounded">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>