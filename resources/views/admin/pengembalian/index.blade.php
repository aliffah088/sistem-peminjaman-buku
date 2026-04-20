<tbody>
@forelse ($pengembalian as $item)
<tr>
    <td>{{ $loop->iteration }}</td>

    {{-- PEMINJAM --}}
    <td>
        {{ optional(optional($item->peminjaman)->user)->name ?? 'Tidak ada' }}
    </td>

    {{-- BARANG --}}
    <td>
        {{ optional(optional($item->peminjaman)->alat)->nama_alat ?? 'Tidak ada' }}
    </td>

    {{-- TGL PINJAM --}}
    <td>
        {{ optional($item->peminjaman)->tgl_pinjam ?? '-' }}
    </td>

    {{-- TGL KEMBALI --}}
    <td>
        {{ $item->tgl_kembali ?? '-' }}
    </td>

    {{-- STATUS --}}
    <td>
        @if($item->status == 'menunggu')
            <span class="badge bg-warning">Menunggu</span>
        @elseif($item->status == 'disetujui')
            <span class="badge bg-success">Disetujui</span>
        @elseif($item->status == 'ditolak')
            <span class="badge bg-danger">Ditolak</span>
        @else
            <span class="badge bg-secondary">
                {{ $item->status ?? 'Tidak ada' }}
            </span>
        @endif
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">
        Data pengembalian belum ada
    </td>
</tr>
@endforelse
</tbody>