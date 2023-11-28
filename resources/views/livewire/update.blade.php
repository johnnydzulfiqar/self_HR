<div class="card">
    <div class="card-body">
        <form>
            <div class="form-group mb-3">
                <label for="time_from">Dari tanggal:</label>
                <input type="date" class="form-control @error('time_from') is-invalid @enderror" id="time_from"
                       placeholder="Enter Tanggal" wire:model="time_from">
                @error('time_from')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="time_from">Sampai Tanggal:</label>
                <input type="date" class="form-control @error('time_from') is-invalid @enderror" id="time_from"
                          wire:model="time_from" placeholder="Enter Tanggal">
                @error('time_from')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input hidden type="text" class="form-control" id="status"
                          wire:model="status" value="0">
            </div>
            <div class="d-grid gap-2">
                <button wire:click.prevent="update()" class="btn btn-success btn-block">Update</button>
                <button wire:click.prevent="cancel()" class="btn btn-secondary btn-block">Cancel</button>
            </div>
        </form>
    </div>
</div>