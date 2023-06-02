<x-dashboard.layout>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fa-solid fa-scale-unbalanced-flip"></i>
            {{ $cardTitle }}
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="col-md-12">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama anda" required value="{{$user->name}}">
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Nomo HP</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor hp anda" required value="{{$user->phone}}">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{$user->address}}</textarea>
                </div>
                <div class="col-md-12">
                    <label for="profile_image" class="form-label">Profile</label>
                    <input class="form-control" type="file" id="profile_image" name="profile_image" accept="image/*">
                </div>
                <div class="col-12">
                    <x-save-button></x-save-button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard.layout>
