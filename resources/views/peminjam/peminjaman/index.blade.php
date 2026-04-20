<tbody>
    @forelse ($peminjaman as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->alat->nama_alat }}</td>
            <td>{{ $item->tanggal_pinjam }}</td>
            <td>{{ $item->tanggal_kembali }}</td>
            <td>{{ $item->status }}</td>
            <td>Aksi</td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center text-muted">
                ⚠️ Data peminjaman belum ada
            </td>
        </tr>
    @endforelse
</tbody>