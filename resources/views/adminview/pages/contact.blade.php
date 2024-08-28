@extends('layouts.admin')

@section('content')

<script>
    function saveDraft() {
        const to = document.querySelector('input[name="to"]').value;
        const subject = document.querySelector('input[name="subject"]').value;
        const message = document.querySelector('textarea[name="message"]').value;

        localStorage.setItem('draft_to', to);
        localStorage.setItem('draft_subject', subject);
        localStorage.setItem('draft_message', message);

        alert('Draft saved!');
    }

    // Load saved drafts on page load
    document.addEventListener('DOMContentLoaded', () => {
        const to = localStorage.getItem('draft_to');
        const subject = localStorage.getItem('draft_subject');
        const message = localStorage.getItem('draft_message');

        if (to) document.querySelector('input[name="to"]').value = to;
        if (subject) document.querySelector('input[name="subject"]').value = subject;
        if (message) document.querySelector('textarea[name="message"]').value = message;
    });
</script>


<form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Compose New Message</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-group">
                <input name="to" class="form-control" placeholder="To:" required>
            </div>
            <div class="form-group">
                <input name="subject" class="form-control" placeholder="Subject:" required>
            </div>
            <div class="form-group">
                <textarea name="message" id="compose-textarea" class="form-control" style="height: 300px" required></textarea>
            </div>
            <div class="form-group">
                <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="float-right">
                <button type="button" class="btn btn-default" onclick="saveDraft()"><i class="fas fa-pencil-alt"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
            </div>
            <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
        </div>
        <!-- /.card-footer -->
    </div>
</form>

@endsection