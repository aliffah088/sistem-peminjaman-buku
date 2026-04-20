<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
                <form action="{{ route('kategoris.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="w-full border-gray-300 rounded shadow-sm" required>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    <a href="{{ route('kategori.index') }}" class="ml-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>