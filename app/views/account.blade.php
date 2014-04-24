@extends('master')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="well">
      <h3>Account Information</h3>
      {{ Form::open(array('method' => 'POST', 'id' => 'account', 'class' => 'form-horizontal', 'role' => 'form')) }}
        <div class="form-group" style="margin: 10px;">
          <label for="email">Email: </label>
          <input type="email" placeholder="Email" value="{{ Auth::user() -> email }}" class="form-control input-sm" name="email" id="email" required />
        </div>
        <div class="form-group" style="margin: 10px;">
          <label for="password">New Password: </label>
          <input type="password" placeholder="Password" class="form-control input-sm" name="password" id="password" />
        </div>
        <div class="form-group" style="margin: 10px;">
          <label for="confirm_password">Confirm New Password: </label>
          <input type="password" placeholder="Confirm Password" class="form-control input-sm" name="confirm_password" id="confirm_password" />
        </div>
        <button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="save" id="save">
          Save
        </button>
      {{ Form::close() }}
    </div>
  </div>
</div>

@stop