<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
</head>
<body>

<div class="container">
    <h2>Edit Foto Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <br>

    <form id="profileForm" action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Preview Foto Profil -->
        <label for="photoInput">
            <div id="profileImageContainer">
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/profile_photos/' . Auth::user()->photo) }}"
                         class="profile-photo" id="previewImage">
                @else
                    <div class="upload-placeholder" id="uploadPlaceholder">
                        Upload Foto Profil
                    </div>
                @endif
            </div>
        </label>

        <input type="file" class="hidden-input" id="photoInput" accept="image/*">

        <!-- Modal untuk Crop -->
        <div id="cropModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h3>Crop Gambar</h3>
                <div class="crop-container">
                    <img id="cropImage" style="max-width: 100%;">
                </div>
                <button type="button" class="btn btn-success" id="cropButton">Simpan</button>
                <button type="button" class="btn btn-danger" id="closeCrop">Batal</button>
            </div>
        </div>

        <!-- Input tersembunyi untuk menyimpan gambar yang sudah dipotong -->
        <input type="hidden" name="cropped_image" id="croppedImageInput">

        <button type="submit" class="btn btn-primary mt-3">Update Foto</button>
    </form>
</div>

<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let cropper;
    const photoInput = document.getElementById('photoInput');
    const profileImageContainer = document.getElementById('profileImageContainer');
    const cropModal = document.getElementById('cropModal');
    const cropImage = document.getElementById('cropImage');
    const cropButton = document.getElementById('cropButton');
    const closeCrop = document.getElementById('closeCrop');
    const croppedImageInput = document.getElementById('croppedImageInput');

    // Hanya tampilkan modal ketika mengunggah atau mengganti foto
    function openCropper(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                cropImage.src = e.target.result;
                cropModal.style.display = 'flex';

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 2,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(file);
        }
    }

    // Pastikan modal hanya muncul jika ada file yang dipilih
    photoInput.addEventListener('change', function(event) {
        if (photoInput.files.length > 0) {
            openCropper(event);
        }
    }, { once: true });

    // Tombol Simpan Crop
    cropButton.addEventListener('click', function() {
        const canvas = cropper.getCroppedCanvas();
        if (canvas) {
            canvas.toBlob(function(blob) {
                const reader = new FileReader();
                reader.onloadend = function() {
                    croppedImageInput.value = reader.result;
                    document.getElementById('previewImage').src = reader.result;
                    cropModal.style.display = 'none';
                };
                reader.readAsDataURL(blob);
            });
        }
    });

    // Tombol Batal Crop
    closeCrop.addEventListener('click', function() {
        cropModal.style.display = 'none';
    });
});
</script>

</body>
</html>
