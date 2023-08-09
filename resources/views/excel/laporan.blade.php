{{-- disini kita tampilkan data table untuk kita tampilkan di export excel nanti  --}}
<table border="1" id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
    <thead>
      <tr>
        <th width="50px">No</th>
        <th width="100px">Parkir Code</th>
        <th width="100px">Plat Nomor</th>
        <th width="100px">Jenis Kendaraan</th>
        <th width="200px">Waktu Masuk</th>
        <th width="200px">Waktu Keluar</th>
        <th width="100px">Nominal</th>
        <th width="100px">Status</th>
      </tr>
    </thead>
    <tbody>

    {{-- disini kita lakukan perulangan untuk menampilkan data di dalam table  --}}
      @foreach ($parkirKeluar as $item)
        <tr>
          <td height="20px">{{ $loop->iteration }}</td>
          <td height="20px">{{ $item->no_parkir }}</td>
          <td height="20px">{{ $item->plat_nomor }}</td>
          <td height="20px">{{ $item->nama_kendaraan }}</td>
          <td height="20px">{{ \Carbon\Carbon::parse($item->jam_masuk)->translatedFormat('l, d F Y H:i') }}</td>
          <td height="20px">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y H:i') }}</td>
          <td height="20px">@currency($item->nominal)</td>
          <td height="20px">{{ $item->status }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>