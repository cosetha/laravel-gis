tinymce.init({
	selector: 'textarea',
	plugins:
		'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
	imagetools_cors_hosts: [ 'picsum.photos' ],
	menubar: 'file edit view insert format tools table help',
	toolbar:
		'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
	toolbar_sticky: true,
	autosave_ask_before_unload: true,
	autosave_interval: '30s',
	autosave_prefix: '{path}{query}-{id}-',
	autosave_restore_when_empty: false,
	autosave_retention: '2m',
	image_advtab: true,
	images_upload_url: '/upload-img',
	importcss_append: true,
	file_picker_types: 'file, image',
	readonly: false,
	file_picker_callback: function(cb, value, meta) {
		var input = document.createElement('input');
		input.setAttribute('type', 'file');
		input.setAttribute('name', 'file');

		input.onchange = function() {
			var file = this.files[0];
			var fileExtension = [ 'jpeg', 'jpg', 'png', 'gif', 'bmp' ];

			$.ajaxSetup({
				headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			 });

			if ($.inArray(file.name.split('.').pop().toLowerCase(), fileExtension) == -1) {
				var formData = new FormData();
				formData.append('file', file);
				$.ajax({
					type: 'post',
					url: '/upload-file',
					data: formData,
					processData: false,
					contentType: false,
					accepts: 'application / json',
					success: function(response) {
						cb(response.location, { alt: response.alt, text: response.alt, title: response.alt });
					}
				});
			} else {
				var reader = new FileReader();

				reader.onload = function() {
					var nama = file.name.split('.');
					var id = new Date().getTime() + '_' + nama[0];
					var blobCache = tinymce.activeEditor.editorUpload.blobCache;
					var base64 = reader.result.split(',')[1];
					var blobInfo = blobCache.create(id, file, base64);
					blobCache.add(blobInfo);

					cb(blobInfo.blobUri(), { title: file.name });
				};
				reader.readAsDataURL(file);
			}
		};

		input.click();
	},
	templates: [
		{
			title: 'New Table',
			description: 'creates a new table',
			content:
				'<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
		},
		{ title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
		{
			title: 'New list with dates',
			description: 'New List with dates',
			content:
				'<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
		}
	],
	template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
	template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
	height: 400,
	image_caption: true,
	quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
	noneditable_noneditable_class: 'mceNonEditable',
	toolbar_mode: 'sliding',
	contextmenu: 'link image imagetools table',
	branding: false
});
// Prevent jQuery UI dialog from blocking focusin
$(document).on('focusin', function(e) {
	if ($(e.target).closest('.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root').length) {
		e.stopImmediatePropagation();
	}
});
