@php
    $active_sidebar = [1, 0, 0]; // contoh definisi variabel
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LoginAdminDashboard</title>
	<!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("dist/css/adminlte.min.css") }}">
    <link rel="stylesheet" href="{{ asset("src/css/custom.css") }}">
    <!-- SummerNote -->
    <link rel="stylesheet" href="{{ asset("plugins/summernote/summernote-bs4.min.css") }}">
	<script src="https://cdn.jsdelivr.net/npm/apextree"></script>
	<style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            /* font-family: Arial, sans-serif; */
        }

		body h1 {
			text-align: center
		}

        #svg-tree {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #svg-tree svg {
            max-width: 100%;
            max-height: 100%;
        }

		.tampilan-strukturTree{
			margin-left: 250px
		}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

	@include("components.navbar")
	@include("components.sidebar")

	<div class="wrapper">
		<div class="tampilan-strukturTree">
			<h1>Struktur Organisasi SPM</h1>
		
			<div id="svg-tree">
		
			</div>
		</div>
	</div>

	<script>
		const data = {
        id: 'ms',
        data: {
          imageURL: 'https://i.pravatar.cc/300?img=68',
          name: {!! json_encode($roles) !!},
        },
        options: {
          nodeBGColor: '#cdb4db',
          nodeBGColorHover: '#cdb4db',
        },
        children: [
          {
            id: 'mh',
            data: {
              imageURL: 'https://i.pravatar.cc/300?img=69',
              name: 'Mark Hudson',
            },
            options: {
              nodeBGColor: '#ffafcc',
              nodeBGColorHover: '#ffafcc',
            },
            children: [
              {
                id: 'kb',
                data: {
                  imageURL: 'https://i.pravatar.cc/300?img=65',
                  name: 'Karyn Borbas',
                },
                options: {
                  nodeBGColor: '#f8ad9d',
                  nodeBGColorHover: '#f8ad9d',
                },
              },
              {
                id: 'cr',
                data: {
                  imageURL: 'https://i.pravatar.cc/300?img=60',
                  name: 'Chris Rup',
                },
                options: {
                  nodeBGColor: '#c9cba3',
                  nodeBGColorHover: '#c9cba3',
                },
              },
            ],
          },
          {
            id: 'cs',
            data: {
              imageURL: 'https://i.pravatar.cc/300?img=59',
              name: 'Chris Lysek',
            },
            options: {
              nodeBGColor: '#00afb9',
              nodeBGColorHover: '#00afb9',
            },
            children: [
              {
                id: 'Noah_Chandler',
                data: {
                  imageURL: 'https://i.pravatar.cc/300?img=57',
                  name: 'Noah Chandler',
                },
                options: {
                  nodeBGColor: '#84a59d',
                  nodeBGColorHover: '#84a59d',
                },
              },
              {
                id: 'Felix_Wagner',
                data: {
                  imageURL: 'https://i.pravatar.cc/300?img=52',
                  name: 'Felix Wagner',
                },
                options: {
                  nodeBGColor: '#0081a7',
                  nodeBGColorHover: '#0081a7',
                },
              },
            ],
          },
        ],
      };
      const options = {
        contentKey: 'data',
        width: 1200,
        height: 800,
        nodeWidth: 150,
        nodeHeight: 100,
        fontColor: '#fff',
        borderColor: '#333',
        childrenSpacing: 50,
        siblingSpacing: 20,
        direction: 'top',
        enableExpandCollapse: true,
        nodeTemplate: (content) =>
          `<div style='display: flex;flex-direction: column;gap: 10px;justify-content: center;align-items: center;height: 100%;'>
          <img style='width: 50px;height: 50px;border-radius: 50%;' src='${content.imageURL}' alt='' />
          <div style="font-weight: bold; font-family: Arial; font-size: 14px">${content.name}</div>
         </div>`,
        canvasStyle: 'border: 1px solid black;background: #f6f6f6;',
        enableToolbar: true,
      };
      const tree = new ApexTree(document.getElementById('svg-tree'), options);
      tree.render(data);
	</script>
	<script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
	<!-- DataTables  & Plugins -->
	<script src="{{{ asset("plugins/datatables/jquery.dataTables.min.js") }}}"></script>
	<script src="{{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-responsive/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-buttons/js/dataTables.buttons.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/jszip/jszip.min.js") }}"></script>
	<script src="{{ asset("plugins/pdfmake/pdfmake.min.js") }}"></script>
	<script src="{{ asset("plugins/pdfmake/vfs_fonts.js") }}"></script>
	<script src="{{ asset("plugins/datatables-buttons/js/buttons.html5.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-buttons/js/buttons.print.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables-buttons/js/buttons.colVis.min.js") }}"></script>
	<script src="{{ asset("plugins/summernote/summernote-bs4.min.js") }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset("dist/js/adminlte.min.js") }}"></script>
	<!-- Page specific script -->
	
	<script>
		document.getElementById('inputGambar').addEventListener('change', function (e) {
			var fileName = document.getElementById('inputGambar').files[0].name;
			var nextSibling = e.target.nextElementSibling;
			nextSibling.innerText = fileName;
		});
	</script>
	
	<script>
		$(function () {
			@if(session('toastData') != null)
			@if(session('toastData')['success'])
			Swal.fire({
				icon: 'success',
				title: 'Success',
				text: '{!! session('toastData')['text'] !!}',
				toast: true,
				showConfirmButton: false,
				position: 'top-end',
				timer: 3000
			})
			@else
			Swal.fire({
				icon: 'error',
				title: 'Failed',
				text: '{!! session('toastData')['text'] !!}',
				toast: true,
				showConfirmButton: false,
				position: 'top-end',
				timer: 5000
			})
			@endif
			@endif
	
			@if (!$errors->isEmpty())
			Swal.fire({
				icon: 'error',
				title: 'Failed',
				text: 'Failed to add news! {!! $errors->first('judul') !!}{!! $errors->first('isinews') !!}{!! $errors->first('gambar') !!}',
				toast: true,
				showConfirmButton: false,
				position: 'top-end',
				timer: 5000
			})
			@endif
		});
	</script>
	{{-- 
	<script>
		$(function () {
			// Summernote
			$('.summernote').summernote({
				minHeight: 230,
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['fontname', ['fontname']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['table', ['table']],
					['insert', ['link']],
					['view', ['fullscreen', 'codeview', 'help']],
				],
				disableDragAndDrop: true,
			})
		})
	</script> --}}
	<script>
		$(function () {
			// Summernote
			$('.summernote').summernote({
				// placeholder: 'desc...',
				minHeight: 230,
				// disableDragAndDrop: true,
			})
		})
	</script>
</body>
</html>