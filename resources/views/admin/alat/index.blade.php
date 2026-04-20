<tbody>
@forelse ($alat as $a)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>

    <td>{{ $a->nama_alat }}</td>

    <!-- 🔥 FIX KATEGORI -->
    <td>
        {{ optional($a->kategori)->nama_kategori ?? 'Belum ada kategori' }}
    </td>

    <!-- 🔥 FIX STOK -->
    <td class="text-center">
        {{ $a->stok ?? 0 }}
    </td>

    <td class="text-center">
        <a href="{{ route('admin.alat.edit', $a->id_alat) }}" 
           class="btn btn-warning btn-sm text-white">
            Edit
        </a>

        <form action="{{ route('admin.alat.destroy', $a->id_alat) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin hapus {{ $a->nama_alat }}?')">
                Hapus
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center text-muted py-4">
        Data alat masih kosong.
    </td>
</tr>
@endforelse
</tbody>