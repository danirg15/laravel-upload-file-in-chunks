Dropzone.autoDiscover = false;

var token = $('input[name=_token]').val();

$("#file-upload").dropzone({ 
	paramName: 'file',
	url: '/file-upload',
	maxFilesize: 500, //500MB
	method: 'POST',
	chunking: true,
	chunkSize: 1000000, //1MB
	retryChunks: true,
	acceptedFiles: '.csv',
	addRemoveLinks: true,

	sending: function(file, xhr, formData) {
		formData.append('_token', token);
	},

	uploadprogress: function(file, progress, bytesSent) {
		console.log('Progress ' + progress );
	},

	success: function(file, response) {
		console.log('success')
	},

	complete: function(file) {
		console.log('completed')
	},

	error: function(file, error) {
		console.log(error)
	},

	canceled: function(file) {
		console.log('canceled')
	}

});