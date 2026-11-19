<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="referrer" content="strict-origin-when-cross-origin">

    <title>Dashboard Portal — Universitas Ibnu Sina (UIS)</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logouis.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('assets/img/logouis.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    {{--  datatables CSS  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">

    @stack('styles')

    <style id="dynamic-admin-theme">
        :root {
            --uis-purple: {{ $themeSetting->admin_primary_color ?? '#046B26' }};
            --uis-purple-dark: {{ $themeSetting->admin_primary_color ?? '#03521d' }};
            --uis-orange: {{ $themeSetting->admin_accent_color ?? '#FED802' }};
            --uis-orange-dark: {{ $themeSetting->admin_accent_color ?? '#e5c302' }};
        }
        /* Header — Dynamic Admin Theme */
        .header {
            height: {{ $themeSetting->admin_header_height ?? 78 }}px !important;
            background-color: {{ $themeSetting->admin_header_bg_color ?? '#046B26' }} !important;
            border-bottom: 3px solid {{ $themeSetting->admin_header_border_color ?? '#FED802' }} !important;
            box-shadow: 0 2px 14px rgba(0, 0, 0, 0.16) !important;
        }
        #main {
            margin-top: {{ $themeSetting->admin_header_height ?? 78 }}px !important;
        }
        .sidebar {
            top: {{ $themeSetting->admin_header_height ?? 78 }}px !important;
            background-color: {{ $themeSetting->admin_sidebar_bg_color ?? '#ffffff' }} !important;
        }
        .header .logo img {
            max-height: 46px !important;
            height: 46px !important;
        }
        .header .logo span {
            color: {{ $themeSetting->admin_header_brand_color ?? '#FED802' }} !important;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .header .toggle-sidebar-btn {
            color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }} !important;
        }
        .header .toggle-sidebar-btn:hover {
            color: {{ $themeSetting->admin_accent_color ?? '#FED802' }} !important;
        }
        .header .nav-profile {
            color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }} !important;
        }
        .header .nav-profile span {
            color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }} !important;
            font-weight: 700;
        }
        .header .nav-profile:hover span {
            color: {{ $themeSetting->admin_accent_color ?? '#FED802' }} !important;
        }
        .header .nav-icon {
            color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }} !important;
        }
        .header .nav-icon:hover {
            color: {{ $themeSetting->admin_accent_color ?? '#FED802' }} !important;
        }
        .sidebar {
            background-color: {{ $themeSetting->admin_sidebar_bg_color ?? '#ffffff' }} !important;
        }
        .sidebar-nav .nav-link.collapsed {
            background: {{ $themeSetting->admin_sidebar_bg_color ?? '#ffffff' }};
            color: {{ $themeSetting->admin_sidebar_text_color ?? '#046B26' }};
        }
        .sidebar-nav .nav-link.collapsed i {
            color: {{ $themeSetting->admin_sidebar_text_color ?? '#046B26' }};
        }
        .sidebar-nav .nav-link {
            background: {{ $themeSetting->admin_sidebar_active_bg_color ?? '#eaf6ee' }};
            color: {{ $themeSetting->admin_sidebar_active_text_color ?? '#046B26' }};
        }
        .sidebar-nav .nav-link:not(.collapsed) {
            background: {{ $themeSetting->admin_sidebar_active_bg_color ?? '#eaf6ee' }};
            color: {{ $themeSetting->admin_sidebar_active_text_color ?? '#046B26' }};
            border-left: 4px solid {{ $themeSetting->admin_accent_color ?? '#FED802' }};
        }
        .sidebar-nav .nav-link:not(.collapsed) i {
            color: {{ $themeSetting->admin_sidebar_active_text_color ?? '#046B26' }};
        }
        .sidebar-nav .nav-content a {
            color: {{ $themeSetting->admin_sidebar_text_color ?? '#046B26' }};
        }
        .sidebar-nav .nav-content a.active {
            color: {{ $themeSetting->admin_sidebar_active_text_color ?? '#046B26' }};
            font-weight: 700;
        }
        .sidebar-nav .nav-content a.active i {
            background-color: {{ $themeSetting->admin_accent_color ?? '#FED802' }};
        }
        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.collapsed:hover {
            color: {{ $themeSetting->admin_sidebar_hover_text_color ?? '#FED802' }};
            background: {{ $themeSetting->admin_sidebar_hover_bg_color ?? '#f8fcf9' }};
        }
        .sidebar-nav .nav-link:hover i,
        .sidebar-nav .nav-link.collapsed:hover i {
            color: {{ $themeSetting->admin_sidebar_hover_text_color ?? '#FED802' }};
        }
        .btn-primary {
            background-color: {{ $themeSetting->admin_primary_color ?? '#046B26' }} !important;
            border-color: {{ $themeSetting->admin_primary_color ?? '#046B26' }} !important;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: {{ $themeSetting->admin_primary_color ?? '#03521d' }} !important;
            border-color: {{ $themeSetting->admin_primary_color ?? '#03521d' }} !important;
            filter: brightness(0.92);
        }
        .btn-outline-primary {
            color: {{ $themeSetting->admin_primary_color ?? '#046B26' }} !important;
            border-color: {{ $themeSetting->admin_primary_color ?? '#046B26' }} !important;
        }
        .btn-outline-primary:hover {
            background-color: {{ $themeSetting->admin_primary_color ?? '#046B26' }} !important;
            color: #fff !important;
        }
        .btn-warning {
            background-color: {{ $themeSetting->admin_accent_color ?? '#FED802' }} !important;
            border-color: {{ $themeSetting->admin_accent_color ?? '#FED802' }} !important;
            color: #111827 !important;
        }
        .btn-warning:hover {
            background-color: {{ $themeSetting->admin_accent_color ?? '#e5c302' }} !important;
            border-color: {{ $themeSetting->admin_accent_color ?? '#e5c302' }} !important;
            color: #111827 !important;
            filter: brightness(0.94);
        }
        .pagetitle h1 {
            color: {{ $themeSetting->admin_primary_color ?? '#046B26' }};
        }
        .card-title {
            color: {{ $themeSetting->admin_primary_color ?? '#046B26' }};
        }
        .back-to-top {
            background: {{ $themeSetting->admin_primary_color ?? '#046B26' }};
        }
        .back-to-top:hover {
            background: {{ $themeSetting->admin_accent_color ?? '#FED802' }};
        }
    </style>
</head>

<body>
    @include('layouts.dashboard.header')
    @include('layouts.dashboard.sidebar')


    <main id="main" class="main">
        @include('sweetalert::alert')

        @yield('content')

    </main>

    @include('layouts.dashboard.footer')



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- jQuery & DataTables JS (Required for all Admin DataTables) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Global SweetAlert2 Handlers --}}
    <script>
        // Global Logout Confirmation with SweetAlert2
        window.confirmLogout = function (e, url) {
            if (e) e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Keluar',
                text: 'Apakah Anda yakin ingin keluar dari sistem?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#046B26',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-box-arrow-right me-1"></i> Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg border-0',
                    confirmButton: 'px-4 py-2 rounded-3 fw-semibold',
                    cancelButton: 'px-4 py-2 rounded-3 fw-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url || "{{ route('logout') }}";
                }
            });
            return false;
        };

        // Intercept DataTables & Form Deletions with SweetAlert2
        $(document).on('submit', 'form', function (e) {
            const form = this;
            const isDelete = $(form).find('input[name="_method"][value="DELETE"]').length > 0;
            const onsubmitAttr = form.getAttribute('onsubmit') || '';
            const hasConfirm = onsubmitAttr.includes('confirm');
            
            if ((isDelete || hasConfirm) && !form.dataset.swalConfirmed) {
                e.preventDefault();
                e.stopImmediatePropagation();

                let title = 'Apakah Anda yakin?';
                let text = 'Data yang dihapus tidak dapat dikembalikan!';

                // Extract custom message if present in onsubmit="return confirm('...')"
                const match = onsubmitAttr.match(/confirm\(['"](.*?)['"]\)/);
                if (match && match[1]) {
                    title = match[1];
                }

                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-trash-fill me-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0',
                        confirmButton: 'px-4 py-2 rounded-3 fw-semibold',
                        cancelButton: 'px-4 py-2 rounded-3 fw-semibold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.dataset.swalConfirmed = 'true';
                        form.removeAttribute('onsubmit');
                        form.submit();
                    }
                });

                return false;
            }
        });
    </script>

    <!-- TinyMCE CDN & Global Initialization -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce !== 'undefined') {
                const selector = 'textarea.tinymce-editor, textarea.tinymce, textarea#content, textarea#sambutan_dekan, textarea#deskripsi_profil_1, textarea#deskripsi_profil_2';
                
                document.querySelectorAll(selector).forEach(function (el) {
                    if (!tinymce.get(el.id || el)) {
                        tinymce.init({
                            target: el,
                            height: 380,
                            menubar: false,
                            plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | removeformat | code fullscreen',
                            content_style: 'body { font-family: Plus Jakarta Sans, Arial, sans-serif; font-size: 14px; line-height: 1.6; } img { max-width: 100%; height: auto; }',
                            image_title: true,
                            automatic_uploads: true,
                            file_picker_types: 'image',
                            images_upload_handler: function (blobInfo, progress) {
                                return new Promise((resolve, reject) => {
                                    if (blobInfo.blob().size > 2 * 1024 * 1024) {
                                        reject('Ukuran file gambar maksimal 2 MB.');
                                        return;
                                    }

                                    const xhr = new XMLHttpRequest();
                                    xhr.withCredentials = false;
                                    xhr.open('POST', '{{ route("news.upload-image") }}');
                                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                                    xhr.upload.onprogress = (e) => {
                                        progress(e.loaded / e.total * 100);
                                    };

                                    xhr.onload = () => {
                                        if (xhr.status === 403 || xhr.status === 419) {
                                            reject({ message: 'Sesi berakhir atau CSRF token invalid.', remove: true });
                                            return;
                                        }
                                        if (xhr.status < 200 || xhr.status >= 300) {
                                            reject('Gagal upload gambar. HTTP Error: ' + xhr.status);
                                            return;
                                        }
                                        try {
                                            const json = JSON.parse(xhr.responseText);
                                            if (!json || typeof json.location !== 'string') {
                                                reject('Respon server tidak valid.');
                                                return;
                                            }
                                            resolve(json.location);
                                        } catch (e) {
                                            reject('Respon server error: ' + e.message);
                                        }
                                    };

                                    xhr.onerror = () => {
                                        reject('Gagal koneksi ke server saat mengunggah gambar.');
                                    };

                                    const formData = new FormData();
                                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                                    xhr.send(formData);
                                });
                            },
                            file_picker_callback: function (cb, value, meta) {
                                const input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');

                                input.addEventListener('change', (e) => {
                                    const file = e.target.files[0];
                                    if (!file) return;

                                    if (file.size > 2 * 1024 * 1024) {
                                        if (typeof Swal !== 'undefined') {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Ukuran Gambar Terlalu Besar',
                                                text: 'Ukuran file gambar "' + file.name + '" melebihi batas maksimal 2 MB.',
                                                confirmButtonColor: '#046B26'
                                            });
                                        } else {
                                            alert('Ukuran file gambar maksimal 2 MB.');
                                        }
                                        return;
                                    }

                                    const reader = new FileReader();
                                    reader.addEventListener('load', () => {
                                        const id = 'blobid' + (new Date()).getTime();
                                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                        const base64 = reader.result.split(',')[1];
                                        const blobInfo = blobCache.create(id, file, base64);
                                        blobCache.add(blobInfo);

                                        cb(blobInfo.blobUri(), { title: file.name, alt: file.name });
                                    });
                                    reader.readAsDataURL(file);
                                });

                                input.click();
                            }
                        });
                    }
                });
            }
        });

        // Trigger TinyMCE save on form submit so data is always synchronized
        $(document).on('submit', 'form', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });

        // Validasi client-side global: Maksimal 2 MB untuk upload file gambar di semua form
        $(document).on('change', 'input[type="file"]', function () {
            const files = this.files;
            if (!files || files.length === 0) return;

            const acceptAttr = (this.getAttribute('accept') || '').toLowerCase();
            const isImageInput = acceptAttr.includes('image') || acceptAttr.includes('png') || acceptAttr.includes('jpg') || acceptAttr.includes('jpeg') || acceptAttr.includes('webp') || acceptAttr.includes('svg');
            const maxBytes = 2 * 1024 * 1024; // 2 MB

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const isImageFile = (file.type && file.type.startsWith('image/')) || /\.(jpe?g|png|webp|svg|gif)$/i.test(file.name);

                if ((isImageInput || isImageFile) && file.size > maxBytes) {
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar',
                            html: `File <strong>${file.name}</strong> berukuran <strong>${fileSizeMB} MB</strong>.<br>Maksimal ukuran file gambar yang diperbolehkan adalah <strong>2 MB</strong>.`,
                            confirmButtonColor: '#046B26',
                            customClass: {
                                popup: 'rounded-4 shadow-lg border-0',
                                confirmButton: 'px-4 py-2 rounded-3 fw-semibold'
                            }
                        });
                    } else {
                        alert(`File "${file.name}" berukuran ${fileSizeMB} MB. Maksimal ukuran gambar adalah 2 MB.`);
                    }

                    // Reset input file
                    $(this).val('');

                    // Reset preview jika ada di halaman
                    const $form = $(this).closest('form');
                    $form.find('#previewWrap').addClass('d-none');
                    $form.find('#previewImg').attr('src', '');
                    $form.find('#previewDim').text('');
                    $form.find('#logoPreviewWrap').addClass('d-none');
                    $form.find('#currentLogoPreview').addClass('d-none');

                    break;
                }
            }
        });
    </script>

    @stack('scripts')
    @stack('styles')

    <script>
        (function() {
            window.applyLiveAdminTheme = function(t) {
                if (!t) return;
                var styleEl = document.getElementById('dynamic-admin-theme');
                if (!styleEl) return;
                var ahHeight = parseInt(t.admin_header_height || 78, 10);
                styleEl.textContent = `
                    :root {
                        --uis-purple: ${t.admin_primary_color || '#046B26'};
                        --uis-purple-dark: ${t.admin_primary_color || '#03521d'};
                        --uis-orange: ${t.admin_accent_color || '#FED802'};
                        --uis-orange-dark: ${t.admin_accent_color || '#e5c302'};
                    }
                    .header {
                        height: ${ahHeight}px !important;
                        background-color: ${t.admin_header_bg_color || '#046B26'} !important;
                        border-bottom: 3px solid ${t.admin_header_border_color || '#FED802'} !important;
                        box-shadow: 0 2px 14px rgba(0, 0, 0, 0.16) !important;
                    }
                    #main { margin-top: ${ahHeight}px !important; }
                    .sidebar {
                        top: ${ahHeight}px !important;
                        background-color: ${t.admin_sidebar_bg_color || '#ffffff'} !important;
                    }
                    .header .logo img { max-height: 46px !important; height: 46px !important; }
                    .header .logo span { color: ${t.admin_header_brand_color || '#FED802'} !important; font-weight: 800; letter-spacing: 0.5px; }
                    .header .toggle-sidebar-btn, .header .nav-profile, .header .nav-profile span, .header .nav-icon {
                        color: ${t.admin_header_text_color || '#ffffff'} !important;
                    }
                    .header .toggle-sidebar-btn:hover, .header .nav-profile:hover span, .header .nav-icon:hover {
                        color: ${t.admin_accent_color || '#FED802'} !important;
                    }
                    .sidebar-nav .nav-link.collapsed, .sidebar-nav .nav-link.collapsed i, .sidebar-nav .nav-content a {
                        background: ${t.admin_sidebar_bg_color || '#ffffff'};
                        color: ${t.admin_sidebar_text_color || '#046B26'};
                    }
                    .sidebar-nav .nav-link, .sidebar-nav .nav-link:not(.collapsed) {
                        background: ${t.admin_sidebar_active_bg_color || '#eaf6ee'};
                        color: ${t.admin_sidebar_active_text_color || '#046B26'};
                        border-left: 4px solid ${t.admin_accent_color || '#FED802'};
                    }
                    .sidebar-nav .nav-link:not(.collapsed) i, .sidebar-nav .nav-content a.active {
                        color: ${t.admin_sidebar_active_text_color || '#046B26'};
                        font-weight: 700;
                    }
                    .sidebar-nav .nav-content a.active i {
                        background-color: ${t.admin_accent_color || '#FED802'};
                    }
                    .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.collapsed:hover,
                    .sidebar-nav .nav-link:hover i, .sidebar-nav .nav-link.collapsed:hover i {
                        color: ${t.admin_sidebar_hover_text_color || '#FED802'};
                        background: ${t.admin_sidebar_hover_bg_color || '#f8fcf9'};
                    }
                    .btn-primary {
                        background-color: ${t.admin_primary_color || '#046B26'} !important;
                        border-color: ${t.admin_primary_color || '#046B26'} !important;
                    }
                    .btn-outline-primary {
                        color: ${t.admin_primary_color || '#046B26'} !important;
                        border-color: ${t.admin_primary_color || '#046B26'} !important;
                    }
                    .btn-warning {
                        background-color: ${t.admin_accent_color || '#FED802'} !important;
                        border-color: ${t.admin_accent_color || '#FED802'} !important;
                        color: #111827 !important;
                    }
                    .pagetitle h1, .card-title { color: ${t.admin_primary_color || '#046B26'}; }
                    .back-to-top { background: ${t.admin_primary_color || '#046B26'}; }
                    .back-to-top:hover { background: ${t.admin_accent_color || '#FED802'}; }
                `;
            };

            // Broadcast current saved state to Frontend tabs on every Admin load
            var savedTheme = @json(isset($themeSetting) ? array_merge($themeSetting->only(array_keys(\App\Models\ThemeSetting::defaultAttributes())), ['layout' => $themeSetting->getLayoutSections()]) : null);
            try {
                if ('BroadcastChannel' in window) {
                    var bc = new BroadcastChannel('webfikes_live_sync');
                    bc.postMessage({ type: 'content_update', theme: savedTheme, ts: Date.now() });
                }
                if (savedTheme) {
                    localStorage.setItem('webfikes_live_theme', JSON.stringify({ theme: savedTheme, ts: Date.now() }));
                }
                localStorage.setItem('webfikes_live_content_ping', String(Date.now()));
            } catch (e) {}
        })();
    </script>

</body>

</html>
