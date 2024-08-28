<section>
<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Profile Information</h3>
    </div>

    <!-- Profile update form -->
    <form method="post" action="{{ route('user.update', $user->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        
        <div class="card-body">
            <!-- Username Field -->
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Username" 
                       value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @if ($errors->get('name'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <!-- Email Address Field -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" 
                       value="{{ old('email', $user->email) }}" required autocomplete="username">
                @if ($errors->get('email'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card-body -->

        <!-- Submit Button -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'profile-updated')
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                {{ __('Saved.') }}
            </p>
            @endif
        </div>
    </form>
</div>
</section>
