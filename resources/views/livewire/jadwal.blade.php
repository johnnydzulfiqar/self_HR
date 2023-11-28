<div>
    <div class="col-md-12 mb-2">
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        @if($addJadwal)
            @include('livewire.create')
        @endif

        @if($updateJadwal)
            @include('livewire.update')
        @endif
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if(!$addJadwal)
                    <button wire:click="create()" class="btn btn-primary btn-sm float-end">Add New Post</button>
                @endif
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($jadwal as $post)
                            <tr>
                                <td>
                                    {{$post->time_to}}
                                </td>
                                <td>
                                    {{$post->time_from}}
                                </td>
                                <td>{{ $post->status == 0 ? 'Belum Konfirmasi':'Sudah Dikonfirmasi' }}</td>
                                <td>
                                    <button wire:click="edit({{$post->id}})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="destroy({{ $post->id }})"
                                            class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" align="center">
                                    No Posts Found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>