@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="/packages/trumbowyg/dist/ui/trumbowyg.min.css">
<link rel="stylesheet" href="/packages/fine-uploader/fine-uploader-new.css">
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
                						<form class="form-horizontal">
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox"> I'm a victim
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label">Title</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="title" id="scamTitle" placeholder="Title">
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="location" class="col-sm-2 control-label">Location</label>
                								<div class="col-sm-8">
                									<select name="location" id="location" class="form-control" data-placeholder="Select a country...">
                										<option value=""></option>
                										@foreach ($countries as $countryName => $countryId)
                											<option value="{{ $countryId }}">{{ $countryName }}</option>
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
                											<input type="checkbox"> Police Report have been made
                										</label>
                									</div>
                								</div>
                							</div>

											<div class="form-group">
                								<label for="scammer-name" class="col-sm-2 control-label">Scammer Name</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="scammer_name" id="scammer-name" placeholder="Name / Nickname">
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label">Modus Operandi or Scam Details</label>
                								<div class="col-sm-8">
                									<textarea class="form-control" id="modus-operandi" rows="15"></textarea>
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="value-loss" class="col-sm-2 control-label">Value Loss</label>
                								<div class="col-sm-8">
                									<div class="input-group">
                										<input type="text" class="form-control" name="value-loss" id="value-loss" placeholder="Value Loss" style="border-right: 0;">
                										<span class="input-group-btn">
                											<select name="currency" id="currency" class="form-control" style="width: 120px;" data-placeholder="Currency">
                												<option value=""></option>
		                										@foreach ($currencies as $currency)
		                											<option value="{{ $currency }}">{{ $currency }}</option>
		                										@endforeach
		                									</select>
                										</span>
                									</div>
                								</div>
                							</div>

                							<div class="form-group">
                								<label for="uploads" class="col-sm-2 control-label">Uploads</label>
                								<div class="col-sm-8" id="uploads">
                									<input type="text" class="form-control" name="scammer_name" id="scammer-name" placeholder="Name / Nickname">
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
                						<form class="form-horizontal">
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox"> I'm the victim
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<div class="col-sm-offset-2 col-sm-10">
                									<div class="checkbox">
                										<label>
                											<input type="checkbox"> Police Report have been made
                										</label>
                									</div>
                								</div>
                							</div>
                							<div class="form-group">
                								<label for="scamTitle" class="col-sm-2 control-label">Title</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="title" id="scamTitle" placeholder="Title">
                								</div>
                							</div>
                							<input type="hidden" name="external" value="1">
                							<div class="form-group">
                								<label for="url" class="col-sm-2 control-label">URL</label>
                								<div class="col-sm-8">
                									<input type="text" class="form-control" name="title" id="url" placeholder="Link related to the scam story">
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
	$('#uploads').fineUploader({
		template: 'qq-template'
	});
</script>
@endsection
