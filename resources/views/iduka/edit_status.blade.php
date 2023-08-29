@extends('iduka/layouts.app')

@section('title', 'status Project')

@section('contents')


<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <form action="{{ route('update_status', ['id' => $project->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="status">Edit Status</label>
        <select class="form-control" id="status" name="status" required>
            <option value="pending" {{ $project->status === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="aktif" {{ $project->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="selesai" {{ $project->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

        
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
</div>


@endsection

</html>