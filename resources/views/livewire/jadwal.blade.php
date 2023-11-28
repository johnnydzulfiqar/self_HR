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
                @if ( auth()->user()->type == 'user')   
                @if(!$addJadwal)
                    <button wire:click="create()" class="btn btn-primary btn-sm float-end">Add New Post</button>
                @endif
                @endif
            </div>
            <div class="card-body">
               
              
                {{-- <p>Jatah cuti anda = {{ $data }} </p> --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            @if ( auth()->user()->type == 'admin')
                            <th>Atas Nama</th>
                            @endif
                            <th>Dari</th>
                            <th>Sampai</th>
                            <th>Jatah Cuti</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                    @if ( auth()->user()->type == 'user')   
                        @forelse ($jadwal as $post)
                        @if ($user_id = Auth::user()->id === $post->user_id)  
                            <tr>
                                <td>
                                    {{$post->time_to}}
                                </td>
                                <td>
                                    {{$post->time_from}}
                                </td>
                                <td>
                                    {{$post->user->jatah}}
                                </td>
                                <td>{{ $post->status == 0 ? 'Belum Konfirmasi':'Sudah Dikonfirmasi' }}</td>
                                <td>
                                    <button wire:click="edit({{$post->id}})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="destroy({{ $post->id }})"
                                            class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" align="center">
                                    No Posts Found.
                                </td>
                            </tr>
                           
                        @endforelse
                    @endif
                    @if ( auth()->user()->type == 'admin')   
                        @forelse ($jadwal as $post)
                       
                            <tr>
                                <td>
                                    {{$post->user->name}}
                                </td>
                                <td>
                                    {{$post->time_to}}
                                </td>
                                <td>
                                    {{$post->time_from}}
                                </td>
                                <td>
                                    {{$post->user->jatah}}
                                </td>
                                <td>{{ $post->status == 1 ? 'Belum Konfirmasi':'Sudah Dikonfirmasi' }}</td>
                                <td>
                                    @if ($post->status == 1)
                                    <form action="{{ url("/jadwal/{jadwal}/status")}}" method="post" enctype="multipart/form-data">
                                    @csrf 
                                    <input style="display: none;" type="text" hidden name="id" value="{{ $post->id }}" class="form-control">
                                    <input style="display: none;" type="text" hidden name="status" value="1" class="form-control">
                                    <button type="submit" class="btn btn-success">Konfirmasi</button>
                                    @endif
                                </td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="4" align="center">
                                    No Posts Found.
                                </td>
                            </tr>
                           
                        @endforelse
                    @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>