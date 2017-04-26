@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/packages/trumbowyg/dist/ui/trumbowyg.min.css">
<link rel="stylesheet" href="/packages/fine-uploader/fine-uploader-new.css">
<style>
form .text-danger {
	font-size: 25px;
	line-height: 14px;
	height: 14px;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <!-- Tab panes -->
                <h3>Submit Report</h3>
                <div class="panel">
                	<div class="panel-body">
                		<ul class="nav nav-tabs nav-tab-custom" role="tablist">
                			<li role="presentation" class="active"><a href="#new-report" aria-controls="new-report" role="tab" data-toggle="tab">New Report</a></li>
                			<li role="presentation"><a href="#external" aria-controls="external" role="tab" data-toggle="tab">External</a></li>
                		</ul>

                		<div class="tab-content">
                			<div role="tabpanel" class="tab-pane fade in active" id="new-report">
                				<div class="row submit-report">
                					<div class="col-md-12">

                                        <div class="notifications"></div>

                						<form class="form-horizontal" id="submit-story" action="/reports" method="post">
                						    {{ csrf_field() }}
                                            <input type="hidden" name="submit-type" value="story">
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox" name="victim"> I'm a victim
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label"><span class="text-danger">*</span> Title</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="title" id="scamTitle" placeholder="Title" value="{{ old('title') }}">
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="location" class="col-sm-2 control-label"><span class="text-danger">*</span> Location</label>
                								<div class="col-sm-8">
                									<select name="location" id="location" class="form-control" data-placeholder="Select a country...">
                										<option value=""></option>
                										@foreach ($countries as $countryName => $countryId)
                											<option value="{{ $countryName }}"{{ (old('location') == $countryName) ? ' selected' : '' }}>{{ $countryName }}</option>
                										@endforeach
                									</select>
                								</div>
                							</div>
                							<hr>
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-8">
                									<h4>Details</h4>
                								</div>
                							</div>

											<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox" name="police"> Police Report have been made
                										</label>
                									</div>
                								</div>
                							</div>

											<div class="form-group">
                								<label for="scammer-name" class="col-sm-2 control-label"><span class="text-danger">*</span> Scammer Name</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="scammer_name" id="scammer-name" placeholder="Name / Nickname" value="{{ old('scammer_name') }}">
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label"><span class="text-danger">*</span> Modus Operandi or Scam Details</label>
                								<div class="col-sm-8">
                									<textarea class="form-control" id="modus-operandi" name="modus_operandi_or_scam_details" rows="15">
                										{{ old('modus_operandi_or_scam_details') }}
                									</textarea>
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="value-loss" class="col-sm-2 control-label">Value Loss</label>
                								<div class="col-sm-8">
                									<div class="input-group">
                										<input type="text" class="form-control" name="value_loss" id="value-loss" placeholder="Value Loss" style="border-right: 0;" {{ old('modus_operandi_or_scam_details') }}>
                										<span class="input-group-btn">
                											<select name="currency" id="currency" class="form-control" style="width: 120px;" data-placeholder="Currency">
                												<option value=""></option>
		                										@foreach ($currencies as $currency => $countryId)
		                											<option value="{{ $countryId }}"{{ (old('currency') == $countryId) ? ' selected' : '' }}>{{ $currency }}</option>
		                										@endforeach
		                									</select>
                										</span>
                									</div>
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="uploads" class="col-sm-2 control-label">Uploads</label>
                								<div class="col-sm-8" id="uploads">
                									<input type="text" class="form-control" name="uploads" id="uploads" placeholder="Name / Nickname">
                								</div>
                							</div>
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<span class="text-danger">*</span> Indicated required field
                								</div>
                							</div>

                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<button type="submit" class="btn btn-info">Submit</button>
                								</div>
                							</div>
                						</form>
                					</div>
                				</div>
                			</div>
                			<div role="tabpanel" class="tab-pane fade" id="external">
                				<div class="row submit-report">
                					<div class="col-md-12">
                                    <div class="notifications"></div>
                						<form class="form-horizontal" id="submit-url" action="/reports" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="submit-type" value="url">
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox" name="victim"> I'm the victim
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox" name="police"> Police Report have been made
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label"><span class="text-danger">*</span> Title</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="title" id="scamTitle" placeholder="Title">
                								</div>
                							</div>
                							<input type="hidden" name="external" value="1">
                							<div class="form-group">
                								<label for="url" class="col-sm-2 control-label"><span class="text-danger">*</span> URL</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="url" id="url" placeholder="Link related to the scam story">
                								</div>
                							</div>
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<button type="submit" class="btn btn-info">Submit</button>
                								</div>
                							</div>
                						</form>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="/packages/trumbowyg/dist/trumbowyg.min.js"></script>
<script src="/packages/fine-uploader/jquery.fine-uploader.min.js"></script>
<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Drop files here">
        <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
        </div>
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span class="qq-upload-drop-area-text-selector"></span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload files</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
            <li>
                <div class="qq-progress-bar-container-selector">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                </div>
                <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                <span class="qq-upload-file-selector qq-upload-file"></span>
                <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                <span class="qq-upload-size-selector qq-upload-size"></span>
                <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>

        <dialog class="qq-alert-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Close</button>
            </div>
        </dialog>

        <dialog class="qq-confirm-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">No</button>
                <button type="button" class="qq-ok-button-selector">Yes</button>
            </div>
        </dialog>

        <dialog class="qq-prompt-dialog-selector">
            <div class="qq-dialog-message-selector"></div>
            <input type="text">
            <div class="qq-dialog-buttons">
                <button type="button" class="qq-cancel-button-selector">Cancel</button>
                <button type="button" class="qq-ok-button-selector">Ok</button>
            </div>
        </dialog>
    </div>
</script>
<script id="notification" type="text/template">
    <div class="alert alert-danger">
        <ul>
        </ul>
    </div>
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
	$('#modus-operandi').trumbowyg({
		btns: [
			['bold', 'italic', 'underline', 'strikethrough'],
			['unorderedList', 'orderedList']
		],
		autogrow: true,
		removeformatPasted: true
	});
</script>
<script>
	$('#location').selectize();
	$('#currency').selectize({
		inputClass: 'form-control selectize-input',
		dropdownParent: "body",
		placeholder: 'Currency'
	});
</script>
<script>
	var uploadFile = $('#uploads').fineUploader({
        request: {
            endpoint: '/reports/upload'
        },
		template: 'qq-template',
        autoUpload: false
	});

	$('form#submit-story').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/reports',
			data: $(this).serialize(),
			success: function (msg) {

                swal(
                  'Good!',
                  'Your report have been submitted!',
                  'success'
                );
                var submittedFileCount = uploadFile.fineUploader('getUploads', {status: qq.status.SUBMITTED}).length;
                if (submittedFileCount > 0) {
                    uploadFile.fineUploader('uploadStoredFiles');
                }
			},
			error: function (errors) {
				var errors = $.parseJSON(errors.responseText);
                $notification = $.parseHTML($('#notification').clone().html());
                $('form#submit-story').find(":input").removeClass('has-error');
                for (error in errors) {
                    $($notification).find('ul').append('<li>'+errors[error][0]+'</li>');
                    $('form#submit-story').find(":input[name="+error+"]").closest('.form-group').addClass('has-error');
                }
                $('#new-report').find('.notifications').empty().append($notification);
                swal(
                  'Oops!',
                  'There\'s some errors in your form.',
                  'error'
                )

			}
		})
	})

    $('form#submit-url').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/reports',
            data: $(this).serialize(),
            success: function (msg) {
                swal(
                  'Good!',
                  'Your report have been submitted!',
                  'success'
                );
            },
            error: function (errors) {
                var errors = $.parseJSON(errors.responseText);
                $notification = $.parseHTML($('#notification').clone().html());
                $('form#submit-url').find(":input").removeClass('has-error');
                for (error in errors) {
                    $($notification).find('ul').append('<li>'+errors[error][0]+'</li>');
                    $('form#submit-url').find(":input[name="+error+"]").closest('.form-group').addClass('has-error');
                }
                $('#external').find('.notifications').empty().append($notification);
                swal(
                  'Oops!',
                  'There\'s some errors in your form.',
                  'error'
                )

            }
        })
    })
</script>
@endsection
